<?php require __DIR__.'/../menu.php'; ?>

<div class="page span12">
<h1>Templates &mdash; Files</h1>
<hr/>
<p>You can attach files to your templates just by using the "<strong>@attachment:&lt;filename&gt;</strong>" special code at the top of your template wiki.</p>
<h2>Uploading your files</h2>
<p>Uploading the files is easy. Simply go to <a href="https://billing.snapbill.com/files">https://billing.snapbill.com/files</a> and make sure to use the filename that you want to appear in the email. Be sure to set it to not encrypt, and if you ever want to update the file just choose Replace in the "what to do if file exists" dropdown.</p>
<h2>Linking to the file from templates</h2>
<p>As mentioned before you need to use the <strong>@attachment</strong> tag, and simply list it at the top. For instance if you want to attach policy.pdf, your file should look like:
<pre>@subject:Welcome to SnapBill
@attachment:policy.pdf

== Hi $client-&gt;firstname ==
Welcome to ......
</pre>
<h2>
</div>

