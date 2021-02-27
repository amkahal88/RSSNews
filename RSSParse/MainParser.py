import smtplib
import ssl
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from pymongo import MongoClient
import feedparser


def sendnews(news_html_string, toemail):
    port = 587  # For starttls
    smtp_server = "smtp.gmail.com"
    sender_email = ""
    receiver_email = toemail
    password = ''
    msg = MIMEMultipart('alternative')
    msg['Subject'] = "CodnLoc Newsletter"
    # msg['From'] = me
    # msg['To'] = you

    # Create the body of the message (a plain-text and an HTML version).

    html = news_html_string

    # Record the MIME types of both parts - text/plain and text/html.

    part1 = MIMEText(html, 'html')

    # Attach parts into message container.
    # According to RFC 2046, the last part of a multipart message, in this case
    # the HTML message, is best and preferred.

    msg.attach(part1)

    context = ssl.create_default_context()
    with smtplib.SMTP(smtp_server, port) as server:
        server.ehlo()  # Can be omitted
        server.starttls(context=context)
        server.ehlo()  # Can be omitted
        server.login(sender_email, password)
        server.sendmail(sender_email, receiver_email, msg.as_string())
        server.quit()


# ____start of main_____________________________________________________________________

client = MongoClient("mongodb+srv://amkahal:test123456@cluster0.kt8we.mongodb.net/myFirstDatabase?retryWrites=true&w"
                     "=majority")

mydatabase = client['rss']
mycollection = mydatabase['subscriber']
lastdate = mydatabase['lastdate']

_email = ""
_subid = ""
_status = ""

NewsFeed = feedparser.parse("https://arabic.rt.com/rss/'")

news_html = """\

"""

newsdate = ""

for document in lastdate.find():
    newsdate = document['lastdate']

print(newsdate)

for x in NewsFeed['entries']:
    if x['published'] > newsdate:
        news_html += "<p>" + x['published'] + "</p>"
        news_html += "<h2>" + x['title'] + "</h2>"
        news_html += "<p>" + x['summary'] + "</p>"
        news_html += "<a href=" + x['link'] + ">رابط الخبر</a>"
        news_html += "<br><br>"
        lastdateobj = {
            'lastdate': NewsFeed['entries'][0]['published']
        }
        result = lastdate.insert_one(lastdateobj)
        print("yes akbar")

for document in mycollection.find():
    _email = document['email']
    _subid = document['_id']
    _status = document['status']
    unsub_link = "<p>you are receiving this email because you are already subscribed, to cancel please click:<p><a " \
                 "href=\"http://localhost/page/unsubscribe.php?id=" + str(_subid) + "\">Unsubscribe.</a><br><br><br> "

    if _status:
        sendnews(unsub_link + news_html, _email)


