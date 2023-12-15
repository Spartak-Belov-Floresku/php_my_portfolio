<h2 class="titlecodes">Check User Sign Up Name Ajax PHP Social Network</h2>

<p class="descriptioncode">
Here you will get a free script example that accomplishes checking a user's name in a sign up 
form using a simple Javascript Ajax post to a PHP class. The PHP class will check our MySQL database 
to see if the username is already taken or not and lets the user know right away while 
they are filling out the sign up form. 
</p>
<h3 class="coderef">index.php</h3>
<code>
<p class="code-phptags">&lt;?php</p>
<span class="code-elem">
require_once(<span class="code-comment">"Usernamecheck.php"</span>);<br>
&nbsp;&nbsp;&nbsp;&nbsp;if(isset($_POST[<span class="code-comment">"namecheck"</span>]) && $_POST[<span class="code-comment">"namecheck"</span>] != <span class="code-comment">""</span>){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$username = new Usernamecheck();<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo $username->getUsername($_POST[<span class="code-comment">"namecheck"</span>]);<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;exit();<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>

<p class="code-phptags">?&gt;</p>
&lt;!DOCTYPE html&gt;<br>
&lt;html&gt;
<p class="code-elem">&lt;script&gt;</p>
function checkusername(){<br><br>
	&nbsp;&nbsp;&nbsp;var status = document.getElementById(<span class="code-str">"usernamestatus"</span>);<br>
	&nbsp;&nbsp;&nbsp;var u = document.getElementById(<span class="code-str">"uname"</span>).value;<br><br>
	&nbsp;&nbsp;&nbsp;if(u != ""){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;status.innerHTML = <span class="code-str">'checking...'</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var hr = new XMLHttpRequest();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hr.open(<span class="code-str">"POST"</span>, <span class="code-str">"."</span>, true);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hr.setRequestHeader(<span class="code-str">"Content-type"</span>, <span class="code-str">"application/x-www-form-urlencoded"</span>);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hr.onreadystatechange = function() {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(hr.readyState == 4 && hr.status == 200) {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;status.innerHTML = hr.responseText;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var v = <span class="code-str">"namecheck="</span>+u;<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hr.send(v);<br>
}<br>
<p class="code-elem">&lt;/script&gt;</p>
&lt;body&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;h1&gt;Type your username here:&lt;/h1&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;input <span class="code-phptags">type</span>="text" <span class="code-phptags">name</span>="uname" <span class="code-phptags">id</span>="uname" <span class="code-phptags">onkeyup</span>="checkusername()" <span class="code-phptags">onBlur</span>="checkusername()" <span class="code-phptags">maxlength</span>="15"&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;p <span class="code-phptags">id</span>="usernamestatus"&gt;&lt;/p&gt;<br>
&lt;/body&gt;<br>
&lt;/html&gt;
</span>
</code>

<h3 class="coderef">Usernamecheck.php</h3>
<code>
<p class="code-phptags">&lt;?php</p>

<span class="code-elem">class Usernamecheck{<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;public function getUsername($username){<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$username = preg_replace(<span class="code-comment">'#[^a-z0-9]#i'</span>,<span class="code-comment"> ''</span>, $username);<br>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (strlen($username) < 4)<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return <span class="code-comment">'4 - 15 characters please'</span>;<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (is_numeric($username[0]))<br> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return <span class="code-comment">'First character must be a letter'</span>;<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sql = <span class="code-comment">"SELECT id FROM users WHERE username = ? LIMIT 1"</span>;<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$db = Database::getInstance();<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(!$db->query($sql, array($username))->_error){<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($db->count_() < 1)<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return <span class="code-comment">'&lt;strong&gt;'</span> . $username . <span class="code-comment">'&lt;/strong&gt; is OK'</span>;<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return <span class="code-comment">'&lt;strong&gt;'</span> . $username . <span class="code-comment">'&lt;/strong&gt; is taken'</span>;<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$db->close();<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else{<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return <span class="code-comment">'DB is not working...'</span>;<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
		&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
}
</span>
<p class="code-phptags">?&gt;</p>
</code>

