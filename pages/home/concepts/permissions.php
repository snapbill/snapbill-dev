<?php require __DIR__.'/../menu.php'; ?>

<div class="page span12">
<h1>Permissions</h1>
<hr/>
<h2>System design</h2>
<p>The SnapBill permission system runs according to a <a href="#longest-prefix">longest prefix match</a> based URL system that matches the structure within SnapBill. By default all users simply have the <strong>/</strong> permission enabled. You can enable or disable <strong>/client</strong> (access to a single client) or <strong>/contact/update</strong> (ability to update a contact)</p>
<h2>Longest prefix match</h2>
The system works by looking for the <strong>ALLOW</strong>/<strong>DENY</strong> code on the longest matching prefix of the current URL or required permission. For example if you wanted to disallow access to everything by default, allow access to single clients (but not to update them) &ndash; you could use the following rules:<br/>
<pre><strong>DENY </strong> /
<strong>ALLOW</strong> /client
<strong>DENY </strong> /client/update</pre>
<h2>Simple examples</h2>
<p>Allow access to search and view clients, but not to do anything else with them</p>
<pre>
<strong>DENY </strong> /
<strong>ALLOW</strong> /clients
<strong>ALLOW</strong> /client
<strong>DENY </strong> /client/*
</pre>
<p>Allow access to the system as usual, but don't allow anything in the setup or statistics area</p>
<pre>
<strong>ALLOW</strong> /
<strong>DENY </strong> /setup
<strong>DENY </strong> /statistics
</pre>
</div>

