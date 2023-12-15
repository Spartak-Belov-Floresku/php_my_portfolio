<h2 class="titlecodes">Upload files to database (JSP + AJAX + Servlet +  MySQL)</h2>

<p class="descriptioncode">
Here the simple example of code can implement a Java web application that uploads files to server and save the files into database.
Using Servlet 3.0 we can write code to handle file upload easily.
Using AJAX technology is going to help to send request to the server and upload data to the database without
 reloading the browser which is going to improve the efficiency of the application.
We will store uploaded files in MySQL database. 
</p>

<h3 class="coderef">Creating MySQL database & table</h3>
<code>
<span class="code-elem">
create database contacts;<br><br>
 
use cotancts;<br><br>
 
CREATE TABLE <span class="code-brown">`users`</span> (<br>
&nbsp;&nbsp;&nbsp;<span class="code-brown">`id`</span> int(<span class="code-phptags">11</span>) NOT NULL AUTO_INCREMENT,<br>
&nbsp;&nbsp;&nbsp;<span class="code-brown">`first_name`</span> varchar(<span class="code-phptags">45</span>) DEFAULT NULL,<br>
&nbsp;&nbsp;&nbsp;<span class="code-brown">`last_name`</span> varchar(<span class="code-phptags">45</span>) DEFAULT NULL,<br>
&nbsp;&nbsp;&nbsp;<span class="code-brown">`photo`</span> mediumblob,<span class="code-comment"> // File will be stored in the column photo which is of type mediumblob which can store up to 16 MB of binary data</span><br>
&nbsp;&nbsp;&nbsp;<span class="code-brown">`extension`</span> varchar(<span class="code-phptags">10</span>) DEFAULT NULL,<br>
&nbsp;&nbsp;&nbsp;PRIMARY KEY (<span class="code-brown">`id`</span>)<br>
) ENGINE=InnoDB DEFAULT CHARSET=latin1<br>
</span>
</code>

<h3 class="coderef">index.jsp</h3>
<code>
<span class="code-elem">
&lt;?xml <span class="code-phptags">version</span>="1.0" encoding="ISO-8859-1" ?&gt;<br>
</span>
&lt;%@ page language="java" contentType="text/html; charset=ISO-8859-1"<br>
    pageEncoding="ISO-8859-1"%&gt;<br>
<span class="code-elem">
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;<br>
&lt;html <span class="code-phptags">xmlns</span>="http://www.w3.org/1999/xhtml"&gt;<br>
&lt;head&gt;<br>
&lt;meta <span class="code-phptags">http-equiv</span>="Content-Type" <span class="code-phptags">content</span>="text/html; <span class="code-phptags">charset</span>=ISO-8859-1" /&gt;<br>
&lt;title&gt;Upload data to MySQL&lt;/title&gt;
<p class="code-elem">&lt;script&gt;</p>
var senddata = function(){<br><br>
	&nbsp;&nbsp;&nbsp;var <span class="code-brown">status</span> = <span class="code-brown">document</span>.getElementById(<span class="code-comment">"status"</span>);<br>
	&nbsp;&nbsp;&nbsp;var formdata = new FormData();<br><br>
	&nbsp;&nbsp;&nbsp;formdata.append(<span class="code-comment">"firstname"</span>, <span class="code-brown">document</span>.getElementById(<span class="code-comment">"firstname"</span>).value);<br>
	&nbsp;&nbsp;&nbsp;formdata.append(<span class="code-comment">"lastname"</span>, <span class="code-brown">document</span>.getElementById(<span class="code-comment">"lastname"</span>).value);<br>
	&nbsp;&nbsp;&nbsp;formdata.append(<span class="code-comment">"photo"</span>, <span class="code-brown">document</span>.getElementById(<span class="code-comment">"photo"</span>).files[<span class="code-phptags">0</span>]);<br>
	&nbsp;&nbsp;&nbsp;var hr = new XMLHttpRequest();<br>
	&nbsp;&nbsp;&nbsp;hr.<span class="code-brown">open</span>(<span class="code-comment">"POST"</span>, <span class="code-comment">"uploadservlet"</span>);<br>
	&nbsp;&nbsp;&nbsp;hr.onreadystatechange = function() {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(hr.readyState == <span class="code-phptags">4</span> && hr.status == <span class="code-phptags">200</span>) {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-brown">status</span>.innerHTML = hr.responseText;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else{<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-brown">status</span>.innerHTML = hr.responseText;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;hr.send(formdata);<br>
	&nbsp;&nbsp;&nbsp;<span class="code-brown">status</span>.innerHTML = <span class="code-comment">"sending...."</span>;<br>
}<br>
<p class="code-elem">&lt;/script&gt;</p>
<p class="code-elem">&lt;/head&gt;</p>
&lt;body&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;center&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;h1&gt;File Upload to Database Demo&lt;/h1&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;table <span class="code-phptags">border</span>="0"&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;First Name:&lt;/td&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;&ltinput <span class="code-phptags">type</span>="text" <span class="code-phptags">id</span>="firstname" <span class="code-phptags">size</span>="50"/&gt;&lt;/td&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tr&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;Last Name:&lt;/td&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;&ltinput <span class="code-phptags">type</span>="text" <span class="code-phptags">id</span>="lastname" <span class="code-phptags">size</span>="50"/&gt;&lt;/td&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tr&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;Portrait Photo:&lt;/td&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;&ltinput <span class="code-phptags">type</span>="file" <span class="code-phptags">id</span>="photo" <span class="code-phptags">size</span>="50"/&gt;&lt;/td&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tr&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td colspan="2"&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input <span class="code-phptags">type</span>="submit" <span class="code-phptags">value</span>="Save" <span class="code-phptags">onclick</span>="senddata()"&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/td&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tr&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/table&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;/center&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;p <span class="code-phptags">id</span>="status" <span class="code-phptags">style</span>="text-align:center;"&gt;${message}&lt;/p&gt;<br>
&lt;/body&gt;<br>
&lt;/html&gt;
</span>
</code>

<h3 class="coderef">FileUploadDBServlet.java</h3>
<code>
<span class="code-phptags">package</span> com.controller;<br><br>

<span class="code-phptags">import</span> java.io.*;<br>
<span class="code-phptags">import</span> java.sql.Connection;<br>
<span class="code-phptags">import</span> java.sql.DriverManager;<br>
<span class="code-phptags">import</span> java.sql.PreparedStatement;<br>
<span class="code-phptags">import</span> java.sql.SQLException;<br><br>

<span class="code-phptags">import</span> javax.servlet.ServletException;<br>
<span class="code-phptags">import</span> javax.servlet.annotation.MultipartConfig;<br>
<span class="code-phptags">import</span> javax.servlet.annotation.WebServlet;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServlet;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServletRequest;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServletResponse;<br>
<span class="code-phptags">import</span> javax.servlet.http.Part;<br><br>


<span class="code-comment">@WebServlet</span>(<span class="code-phptags">name = <span class="code-str">"FileUploadDBServlet"</span>, urlPatterns = { <span class="code-str">"/uploadservlet"</span> }</span>)<br>
<span class="code-comment">@MultipartConfig</span>(<span class="code-phptags">maxFileSize = </span><span class="code-str">16177215</span>) <span class="code-comment"> // upload file's size up to 16MB</span><br><br>

<span class="code-phptags">public class</span> FileUploadDBServlet <span class="code-phptags">extends</span> HttpServlet {<br><br>
<span class="code-comment">&nbsp;&nbsp;&nbsp;// database connection settings</span><br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> String dbURL = <span class="code-comment">"jdbc:mysql://localhost:3306/contacts"</span>;<br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> String dbUser = <span class="code-comment">"root"</span>;</br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> String dbPass = <span class="code-comment">"secret"</span>;<br><br>

    <span class="code-phptags">&nbsp;&nbsp;&nbsp;protected void</span> doPost(HttpServletRequest request,<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HttpServletResponse response) <span class="code-phptags">throws</span> ServletException, IOException {<br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// gets values of text fields</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String firstName = request.getParameter(<span class="code-comment">"firstname"</span>);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String lastName = request.getParameter(<span class="code-comment">"lastname"</span>);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String extension = <span class="code-comment">""</span>;<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// input stream of the upload file</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;InputStream inputStream = <span class="code-phptags">null</span>;<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// obtains the upload file part in this multipart request</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Part filePart = request.getPart(<span class="code-comment">"photo"</span>);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (filePart != <span class="code-phptags">null</span>) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// prints out some information for debugging</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;extension = filePart.getContentType().substring(filePart.getContentType().lastIndexOf(<span class="code-comment">"/"</span>)+<span class="code-phptags">1</span>);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(filePart.getName());<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(filePart.getSize());<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(extension);<br><br>
             
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// obtains input stream of the upload file</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;inputStream = filePart.getInputStream();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// connection to the database</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Connection db = <span class="code-phptags">null</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// message will be sent back to client</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String message = <span class="code-phptags">null</span>;<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;try {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// connects to the database</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DriverManager.registerDriver(new com.mysql.jdbc.Driver());<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;db = DriverManager.getConnection(dbURL, dbUser, dbPass);<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// constructs SQL statement</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String sql = <span class="code-comment">"INSERT INTO users (first_name, last_name, photo, extension) values (?, ?, ?, ?)"</span>;<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PreparedStatement statement = db.prepareStatement(sql);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;statement.setString(<span class="code-phptags">1</span>, firstName);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;statement.setString(<span class="code-phptags">2</span>, lastName);<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (inputStream != <span class="code-phptags">null</span>) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// fetches input stream of the upload file for the blob column</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;statement.setBlob(<span class="code-phptags">3</span>, inputStream);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;statement.setString(<span class="code-phptags">4</span>, extension);;<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// sends the statement to the database server</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;int row = statement.executeUpdate();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (row > 0) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;message = <span class="code-comment">"File uploaded and saved into database"</span>;<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;} catch (SQLException ex) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;message = "ERROR: " + ex.getMessage();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ex.printStackTrace();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;} finally {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (db != null) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// closes the database connection</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;try {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;db.close();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;} catch (SQLException ex) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ex.printStackTrace();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// sets the message in the responce</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PrintWriter out = response.getWriter();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;out.print(message);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;out.flush();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;out.close();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
    &nbsp;&nbsp;&nbsp;}<br>
         

}<br>
</code>