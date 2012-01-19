<?php require __DIR__.'/../menu.php'; ?>

<div class="page span12">
<h1>Making Requests</h1>
<hr/>
<p>The SnapBill API is based off HTTP requests using only the <strong>GET</strong> and <strong>POST</strong> verbs. GET is used for discovery, while POST is used for actual API requests.</p>
<ul>
  <li>GET /v1 &mdash; Retrieve a listing of possible commands</li>
  <li>GET /v1/client/add &mdash; Retrieve the form for adding a new client</li>
  <li>POST /v1/client/add &mdash; Add a new client to the system</li>
  <li>POST /v1/client/84/get &mdash; Get the full accoutn details of a client</li>
  <li>POST /v1/client/list &mdash; Get a list of clients matching an optional search query</li>
</ul>
</div>

