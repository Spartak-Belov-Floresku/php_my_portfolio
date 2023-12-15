
<h2 class="titlecodes">Ajax Get to PHP or JAVA XMLHttpRequest Object Return</h2>

<p class="descriptioncode">
Use the Javascript XMLHttpRequest Object to easily send get method Ajax HTTP requests to PHP script or Servelet
and get return data from any type of interaction that takes place on a website. 
I establish the request object and simply access the events, 
methods, and properties I need for two way Javascript and PHP or JAVA communication.
</p>
<code>
	<p class="code-elem">&lt;script&gt;</p>
	<strong>function ajax_get_content(elem){</strong>
		<p class="code-comment">&nbsp;&nbsp;&nbsp;// Create our XMLHttpRequest object</p>
		&nbsp;&nbsp;&nbsp;var hr = new XMLHttpRequest();
		<p class="code-comment">&nbsp;&nbsp;&nbsp;// Create the url that is used to call PHP script</p>
		&nbsp;&nbsp;&nbsp;var url = <span class="code-str">"dir/"</span>+elem.getAttribute(<span class="code-str">"data-page"</span>)+<span class="code-str">".php";</span>
		<p class="code-comment">&nbsp;&nbsp;&nbsp;// or JAVA Servlet</p>
		&nbsp;&nbsp;&nbsp;var url = elem.getAttribute(<span class="code-str">"data-page"</span>);<br>
		&nbsp;&nbsp;&nbsp;hr.open(<span class="code-str">"GET"</span>, url, true);
		<p class="code-comment">&nbsp;&nbsp;&nbsp;// Set content type header information for sending url in the request</p>
		&nbsp;&nbsp;&nbsp;hr.setRequestHeader(<span class="code-str">"Content-type"</span>, <span class="code-str">"text/html"</span>);
		<p class="code-comment">&nbsp;&nbsp;&nbsp;// Access the onreadystatechange event for the XMLHttpRequest object</p>
		&nbsp;&nbsp;&nbsp;hr.onreadystatechange = function() {<br>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(hr.readyState == 4 && hr.status == 200) {<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;document.getElementById(<span class="code-str">"main"</span>).innerHTML = hr.responseText;<br>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
		&nbsp;&nbsp;&nbsp;}
		<p class="code-comment">&nbsp;&nbsp;&nbsp;// Send the null to the server now... and wait for response to update the main div</p>
		&nbsp;&nbsp;&nbsp;hr.send(null); <span class="code-comment">&nbsp;&nbsp;&nbsp;// Actually execute the request</span><br>
		&nbsp;&nbsp;&nbsp;document.getElementById(<span class="code-str">"main"</span>).innerHTML = <span class="code-str">"processing..."</span>;<br>
		}
	<p class="code-elem">&lt;/script&gt;</p>
	<br>
	&nbsp;&nbsp;&nbsp;..........<br>
	<p class="code-elem">&lt;nav&gt;</p>
		&nbsp;&nbsp;&nbsp;<span class="code-elem">&lt;span <span class="code-alt">data-page=<span class="code-elem">"home"</span></span> <span class="code-alt">onclick=<span class="code-elem">"ajax_get_content(this)"</span></span>&gt;</span>HOME<span class="code-elem">&lt;span&gt;</span><br>
		&nbsp;&nbsp;&nbsp;<span class="code-elem">&lt;span <span class="code-alt">data-page=<span class="code-elem">"products"</span></span> <span class="code-alt">onclick=<span class="code-elem">"ajax_get_content(this)"</span></span>&gt;</span>Products<span class="code-elem">&lt;span&gt;</span>
		<br>&nbsp;&nbsp;&nbsp;.........<br>
			&nbsp;&nbsp;&nbsp;.........<br>
	<p class="code-elem">&lt;/nav&gt;</p>
	&nbsp;&nbsp;&nbsp;..........
	<p class="code-elem">&lt;div <span class="code-alt">id=<span class="code-elem">"main"</span></span>&gt;</p>
	&nbsp;&nbsp;&nbsp;..........<br>
	&nbsp;&nbsp;&nbsp;..........
	<p class="code-elem">&lt;/div&gt;</p>
	&nbsp;&nbsp;&nbsp;........
	
</code>