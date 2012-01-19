<?php require __DIR__.'/menu.php'; ?>

<div class="page span12">
  <h1>API Documentation</h1>
  <hr/>
  <p>The SnapBill API will let you connect to your account programatically, and perform actions such as <a href="/api/commands/invoice-add">creating invoices</a>, <a href="/api/commands/client-list">downloading lists of clients</a>, or even <a href="/api/webhooks/payment-update-state">watching for bounced payments</a>.</p>
  <p>Our API is based on simple RESTful design, however we've taken a whole lot of liberties in order to produce an api interface that is fully accessible straight from your web browser. For more details you can check the <a href="/api/introduction/rest">REST introduction</a>, or try it now at <a href="https://api.snapbill.com">api.snapbill.com</a>. If you still need to signup, head to <a href="https://signup.snapbill.com">signup.snapbill.com</a> first.</p>
  
  <hr/>
  <h2>tl;dr examples</h2>
<pre>
$ # Adding a new client leaving out a number of fields
$ curl -u user:pass -d "firstname=josh&amp;email=josh@example.com" \
&gt;      http://api.snap/v1/client/add.json
{"type":"result","status":"ok","id":81412}
</pre>
<pre>
$ # Search for clients named josh
$ curl -u user:pass -d "query=josh" https://api.snapbill.com/v1/client/list.json
{"type": "list",
 "list": [
   {
     "id":81412,
     "name": "josh",
     "email": "josh@example.com",
     <span class="extended">"depth": 0,
     "xid": "BYZ:T4E",
     "state": "new",
     "number": "001",
     "firstname": "josh",
     "surname": "",
     "company": "",
     "cell": "",
     "country":{
       "code": "US", "iso2": "US", "iso3": "USA", "name": "United States"
     },
     "credit": 0,
     "currency": {
       "code": "USD", "format": "$%.2f", "state": "enabled"
     },
     "payment": "other",
     "totals": {
       "unpaid_invoices":0, "paid_payments":0
     },
     "urls": {
       "statement": "https:\/\/user.snapbill.com\/statement\/BYZ:T4E\/BTTeSWf4znpp"
     },
     "services": []</span>
  }
 ]
}
</pre>
<pre>
$ # Change the clients name to george
$ curl -u user:pass -d firstname=george https://api.snapbill.com/v1/client/81412/update.xml
&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;response xmlns="https://api.snapbill.com/" status="ok" type="result"/&gt;
</pre>
<pre>
$ # Remove the client
$ curl -u user:pass -d "" https://api.snapbill.com/v1/client/81414/delete.txt
[response]
type=result

[result]
status=ok
</pre>
</div>
