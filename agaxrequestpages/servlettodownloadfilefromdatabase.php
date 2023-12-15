<h2 class="titlecodes">Using Servlet to download file from database</h2>

<p class="descriptioncode">
Here, we can implement a solution that allows users downloading files which are stored in database, 
using Servlet, JDBC and MySQL. Retrieve the file’s binary data using the method getBlob(column_name) 
of the returned ResultSet, and obtain its input stream. Set response’s header Content-Disposition so that 
the client will force the users downloading the file. Read byte arrays from the file’s input stream and 
write them to the client using the response’s output stream, until reaching end of the input stream. In this servlet, 
we override only the doGet() method, so we will access it via normal URL. The upload id is passed via the URL’s parameter user. 
In case of error or no record found, the servlet sends appropriate message to the client.
</p>

<h3 class="coderef">Assuming that the users want to downloadin files from the following table</h3><br>
<h3 class="coderef">(MySQL script):</h3>
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

<h3 class="coderef">web.xml</h3>
<code>
<span class="code-elem">
&lt;display-name&gt;downloaderfiles&lt;/display-name&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;welcome-file-list&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;welcome-file&gt;downloadFileServlet&lt;/welcome-file&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/welcome-file-list&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;servlet&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;display-name&gt;DBFileDownloadServlet&lt;/display-name&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;servlet-name&gt;DBFileDownloadServlet&lt;/servlet-name&lt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;servlet-class&gt;com.controller.DBFileDownloadServlet&lt/servlet-class&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/servlet&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;servlet-mapping&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;servlet-name&gt;DBFileDownloadServlet&lt;/servlet-name&gt;<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;url-pattern&gt;/downloadFileServlet&lt;/url-pattern&gt;<br>
 &nbsp;&nbsp;&nbsp;&lt;/servlet-mapping&gt;<br>
</span>
</code>

<h3 class="coderef">index.jsp</h3>
<code>
&lt;%@taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %&gt;<br>
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
&lt;title&gt;Download files from MySQL&lt;/title&gt;<br>
<p class="code-elem">&lt;/head&gt;</p>
&lt;body&gt;<br>

&nbsp;&nbsp;&nbsp;&lt;p&gt;<span class="code-black">${message}</span>&lt;/p&gt;<br>

&nbsp;&nbsp;&nbsp;&lt;c:forEach <span class="code-phptags">var</span>="user" <span class="code-phptags">items</span>="<span class="code-black">${users}</span>"&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a <span class="code-phptags">href</span>="downloadFileServlet?user=&lt;c:out <span class="code-phptags">value</span>='<span class="code-black">${user.id}</span>' /&gt;"&gt;First Name: &lt;c:out <span class="code-phptags">value</span>='<span class="code-black">${user.firstName}</span>' /&gt; Last Name: &lt;c:out <span class="code-phptags">value</span>='<span class="code-black">${user.lastName}</span>'/&gt;&lt;/a&gt;&lt;br&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;/c:forEach&gt;<br>
&lt;/body&gt;<br>
&lt;/html&gt;
</span>
</code>

<h3 class="coderef">DBFileDownloadServlet.java</h3>
<code>
<span class="code-phptags">package</span> com.controller;<br><br>

<span class="code-phptags">import</span> java.io.*;<br>
<span class="code-phptags">import</span> java.sql.Blob;<br>
<span class="code-phptags">import</span> java.sql.Connection;<br>
<span class="code-phptags">import</span> java.sql.DriverManager;<br>
<span class="code-phptags">import</span> java.sql.PreparedStatement;<br>
<span class="code-phptags">import</span> java.sql.ResultSet;<br>
<span class="code-phptags">import</span> java.sql.SQLException;<br>
<span class="code-phptags">import</span> java.sql.Statement;<br><br>

<span class="code-phptags">import</span> javax.servlet.ServletContext;<br>
<span class="code-phptags">import</span> javax.servlet.ServletException;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServlet;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServletRequest;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServletResponse;<br><br>

<span class="code-phptags">import</span> java.util.ArrayList;<br>
<span class="code-phptags">import</span> com.model.Person;<br><br>



<span class="code-phptags">public class</span> DBFileDownloadServlet <span class="code-phptags">extends</span> HttpServlet {<br><br>


<span class="code-comment">&nbsp;&nbsp;&nbsp;// database connection settings</span><br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> String dbURL = <span class="code-comment">"jdbc:mysql://localhost:3306/contacts"</span>;<br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> String dbUser = <span class="code-comment">"root"</span>;</br>
<span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> String dbPass = <span class="code-comment">"secret"</span>;<br><br>

    <span class="code-phptags">&nbsp;&nbsp;&nbsp;protected void</span> doGet(HttpServletRequest request,<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HttpServletResponse response) <span class="code-phptags">throws</span> ServletException, IOException {<br><br>
	
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// size of byte buffer to send file</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">final int</span> BUFFER_SIZE = 4096;<br><br>
	
	
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String id = request.getParameter(<span class="code-comment">"user"</span>);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Connection db = <span class="code-phptags">null</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ArrayList&lt;Person&gt; ArrayPersons = <span class="code-phptags">new</span> ArrayList&lt;Person&gt;();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Person person;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String message = <span class="code-comment">""</span>;<br><br>
		
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">if</span>(id == <span class="code-phptags">null</span>) {<br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">try</span> {<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// connects to the database</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DriverManager.registerDriver(<span class="code-phptags">new</span> com.mysql.jdbc.Driver());<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;db = DriverManager.getConnection(dbURL, dbUser, dbPass);<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// constructs SQL statement</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String sql = <span class="code-comment">"SELECT * FROM users"</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Statement statement = db.createStatement();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ResultSet persons = statement.executeQuery(sql);<br><br>
		            
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">while</span>(persons.next()) {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;person = <span class="code-phptags">new</span> Person();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;person.setId(persons.getString(<span class="code-comment">"id"</span>));<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;person.setFirstName(persons.getString(<span class="code-comment">"first_name"</span>));<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;person.setLastName(persons.getString(<span class="code-comment">"last_name"</span>));<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ArrayPersons.add(person);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;message = <span class="code-comment">"The database has records "</span>+ArrayPersons.size();<br><br>
	
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">catch</span> (SQLException ex){<br><br>
		    	  
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;message = <span class="code-comment">"ERROR: "</span> + ex.getMessage();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ex.printStackTrace();<br><br>
		            
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">finally</span>{<br>
		    	  
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">if</span>(db != <span class="code-phptags">null</span>){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// closes the database connection</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">try</span>{<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;db.close();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">catch</span>(SQLException ex){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ex.printStackTrace();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
		            
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
			  
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;request.setAttribute(<span class="code-comment">"users"</span>,ArrayPersons);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;request.setAttribute(<span class="code-comment">"message"</span>,message);<br><br>
				
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;getServletContext().getRequestDispatcher(<span class="code-comment">"/WEB-INF/content/index.jsp"</span>).forward(request,response);<br><br>
			  
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">else</span>{<br><br>
		 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">try</span>{<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// connects to the database</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DriverManager.registerDriver(new com.mysql.jdbc.Driver());<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;db = DriverManager.getConnection(dbURL, dbUser, dbPass);<br><br>
	 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// queries the database</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String sql = <span class="code-comment">"SELECT * FROM users WHERE id = ?"</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PreparedStatement statement = db.prepareStatement(sql);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;statement.setInt(<span class="code-phptags">1</span>, Integer.parseInt(id));<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ResultSet result = statement.executeQuery();<br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">if</span>(result.next()){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String fileName = result.getString(<span class="code-comment">"first_name"</span>);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// gets file name and file blob data</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Blob blob = result.getBlob(<span class="code-comment">"photo"</span>);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;InputStream inputStream = blob.getBinaryStream();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;int fileLength = inputStream.available();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// gets extension of the file</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String extension = result.getString(<span class="code-comment">"extension"</span>);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ServletContext context = getServletContext();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// sets MIME type for the file download</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String mimeType = context.getMimeType(fileName);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">if</span>(mimeType == <span class="code-phptags">null</span>){<br>        
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mimeType = <span class="code-phptags">"application/octet-stream"</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>            
	                 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// set content properties and header attributes for the response</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;response.setContentType(mimeType);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;response.setContentLength(fileLength);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String headerKey = <span class="code-comment">"Content-Disposition"</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String headerValue = String.format(<span class="code-comment">"attachment; filename=\"%s\""</span>, fileName+<span class="code-comment">"."</span>+extension);<br>
	                
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;response.setHeader(headerKey, headerValue);<br><br>
	 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// writes the file to the client</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OutputStream outStream = response.getOutputStream();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;byte[] buffer = new byte[BUFFER_SIZE];<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;int bytesRead = <span class="code-phptags">-1</span>;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">while</span>((bytesRead = inputStream.read(buffer)) != <span class="code-phptags">-1</span>){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;outStream.write(buffer, 0, bytesRead);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;inputStream.close();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;outStream.close();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">else</span>{<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// no file found</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;response.getWriter().print(<span class="code-comment">"File not found for the id: "</span> + id);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">catch</span>(SQLException ex){<br>
	        	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ex.printStackTrace();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;response.getWriter().print(<span class="code-comment">"SQL Error: "</span> + ex.getMessage());<br>
	            
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">catch</span>(IOException ex){<br>
	        	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ex.printStackTrace();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;response.getWriter().print(<span class="code-comment">"IO Error: "</span> + ex.getMessage());<br>
	            
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">finally</span>{<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">if</span>(db != <span class="code-phptags">null</span>){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// closes the database connection<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">try</span>{<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;db.close();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<span class="code-phptags">catch</span>(SQLException ex){<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ex.printStackTrace();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>          
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;}<br>

	}<br>
</code>