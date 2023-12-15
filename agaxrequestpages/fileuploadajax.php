<h2 class="titlecodes">File Upload Progress Bar Meter Ajax and PHP or JAVA</h2>

<p class="descriptioncode">
You can use HTML + Ajax + PHP or JAVA to render an elegant file upload
 progress bar in your file upload forms. It is desirable to render a file upload progress bar 
 when users upload files to a server, much like the way YouTube renders a file upload progress bar every time 
 we upload a video to their network. The new HTML5 progress element has been made specifically for developers
 to use in scenarios such as this, it automatically matches the specific browser software visually, 
 but you can customize your loading bar graphics for branding or consistency in all the different browsers.
 Due to the fact that we are using a new HTML5 element, this application may not work as intended in 
 old versions of browser software. Please use a modern popular browser software when experimenting with this code.
</p>

<h3 class="coderef">upload.html</h3>
<code>
<p class="code-elem">&lt;!DOCTYPE html&gt;</p>
<p class="code-elem">&lt;html&gt;</p>
<p class="code-elem">&lt;head&gt;</p>
<p class="code-elem">&lt;script&gt;</p>
<p class="code-comment">// The cross browser method that gives ability to get element by id...</p>
function getElemId(id) {<br>
	&nbsp;&nbsp;&nbsp;if (document.getElementById) {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return document.getElementById(id);<br>
	&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;else if (document.all) {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return window.document.all[id];<br>
	&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;else if (document.layers) {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return window.document.layers[id];<br>
	&nbsp;&nbsp;&nbsp;}<br>
}
<p class="code-comment">// The main method that is going to upload a file to the server</p>
function uploadFile(){<br>
	&nbsp;&nbsp;&nbsp;var uploadfile = getElemId(<span class="code-str">"file"</span>).files[0];<br><br>
	&nbsp;&nbsp;&nbsp;<span class="code-comment">// The directive is going to show us properties of a file<br>
	&nbsp;&nbsp;&nbsp;// Using for a develop purpose</span>
	<p class="code-comment">&nbsp;&nbsp;&nbsp;// alert(file.name+" | "+file.size+" | "+file.type);</p>
	<br>&nbsp;&nbsp;&nbsp;var formdata = new FormData();<br>
	&nbsp;&nbsp;&nbsp;formdata.append(<span class="code-str">"uploadfile"</span>, uploadfile);<br>
	&nbsp;&nbsp;&nbsp;var hr = new XMLHttpRequest();<br>
	&nbsp;&nbsp;&nbsp;hr.upload.addEventListener(<span class="code-str">"progress"</span>, progressHandler, false);<br>
	&nbsp;&nbsp;&nbsp;hr.addEventListener(<span class="code-str">"load"</span>, completeHandler, false);<br>
	&nbsp;&nbsp;&nbsp;hr.addEventListener(<span class="code-str">"error"</span>, errorHandler, false);<br>
	&nbsp;&nbsp;&nbsp;hr.addEventListener(<span class="code-str">"abort"</span>, abortHandler, false);
	<p class="code-comment">&nbsp;&nbsp;&nbsp;// You can use open method that calls PHP script</p>
	&nbsp;&nbsp;&nbsp;hr.open(<span class="code-str">"POST"</span>, <span class="code-str">"FilesUpload.php"</span>);<br>
	<p class="code-comment">&nbsp;&nbsp;&nbsp;// or JAVA Servlet</p>
	&nbsp;&nbsp;&nbsp;hr.open(<span class="code-str">"POST"</span>, <span class="code-str">"filesupload"</span>);<br>
	&nbsp;&nbsp;&nbsp;hr.send(formdata);<br>
}<br>

function progressHandler(event){<br>
	&nbsp;&nbsp;&nbsp;getElemId(<span class="code-str">"loaded_n_total"</span>).innerHTML = <span class="code-str">"Uploaded "</span>+event.loaded+<span class="code-str">" bytes of "</span>+event.total;<br>
	&nbsp;&nbsp;&nbsp;var percent = (event.loaded / event.total) * 100;<br>
	&nbsp;&nbsp;&nbsp;getElemId(<span class="code-str">"progressBar"</span>).value = Math.round(percent);<br>
	&nbsp;&nbsp;&nbsp;getElemId(<span class="code-str">"status"</span>).innerHTML = Math.round(percent)+<span class="code-str">"% uploaded... please wait"</span>;<br>
}<br>

function completeHandler(event){<br>
	&nbsp;&nbsp;&nbsp;getElemId(<span class="code-str">"status"</span>).innerHTML = event.target.responseText;<br>
	&nbsp;&nbsp;&nbsp;getElemId(<span class="code-str">"progressBar"</span>).value = 0;<br>
}<br>

function errorHandler(event){<br>
	&nbsp;&nbsp;&nbsp;getElemId(<span class="code-str">"status"</span>).innerHTML = <span class="code-str">"Upload Failed"</span>;<br>
}<br>

function abortHandler(event){<br>
	&nbsp;&nbsp;&nbsp;getElemId(<span class="code-str">"status"</span>).innerHTML = <span class="code-str">"Upload Aborted"</span>;<br>
}
<p class="code-elem">&lt;/script&gt;</p>
<p class="code-elem">&lt;/head&gt;</p>
<p class="code-elem">&lt;body&gt;</p>

<span class="code-elem">&lt;h2&gt;</span>HTML5 File Upload Progress Bar<span class="code-elem">&lt;/h2&gt;</span><br>
<span class="code-elem">&lt;input type=<span class="code-str">"file"</span> id=<span class="code-str">"file"</span>&gt;</span><br>
<span class="code-elem">&lt;input type=<span class="code-str">"button"</span> value=<span class="code-str">"Upload File"</span> onclick=<span class="code-str">"uploadFile()"</span>&gt;</span><br>
<span class="code-elem">&lt;progress id=<span class="code-str">"progressBar"</span> value=<span class="code-str">"0"</span> max=<span class="code-str">"100"</span> style=<span class="code-str">"width:500px;"</span>&gt;</span><span class="code-elem">&lt;/progress&gt;</span><br>
<span class="code-elem">&lt;h3 id=<span class="code-str">"status"</span> &gt;</span><span class="code-elem">&lt;/h3&gt;</span><br>
<span class="code-elem">&lt;p id=<span class="code-str">"loaded_n_total"</span> &gt;</span><span class="code-elem">&lt;/p&gt;</span>
<p class="code-elem">&lt;/body&gt;</p>
<p class="code-elem">&lt;/html&gt;</p>
</code>
<h3 class="coderef">FilesUpload.php</h3>
<code>
<p class="code-phptags">&lt;?php</p>
	$fileName = $_FILES[<span class="code-str">"uploadfile"</span>][<span class="code-str">"name"</span>];<span class="code-comment">// The file name</span><br>
	$fileTmpLoc = $_FILES[<span class="code-str">"uploadfile"</span>][<span class="code-str">"tmp_name"</span>];<span class="code-comment">// File in the PHP tmp folder</span><br>
	$fileType = $_FILES[<span class="code-str">"uploadfile"</span>][<span class="code-str">"type"</span>];<span class="code-comment">// The type of file it is</span><br>
	$fileSize = $_FILES[<span class="code-str">"uploadfile"</span>][<span class="code-str">"size"</span>];<span class="code-comment">// File size in bytes</span><br>
	$fileErrorMsg = $_FILES[<span class="code-str">"uploadfile"</span>][<span class="code-str">"error"</span>];<span class="code-comment">// 0 for false... and 1 for true</span><br>
	if (!$fileTmpLoc) {<span class="code-comment"> // if file not chosen</span><br>
    &nbsp;&nbsp;&nbsp;echo <span class="code-str">"ERROR: Please browse for a file before clicking the upload button."</span>;<br>
    &nbsp;&nbsp;&nbsp;exit();<br>
	}<br>
	if(move_uploaded_file($fileTmpLoc, <span class="code-str">"imagedir/$fileName"</span>)){<br>
    &nbsp;&nbsp;&nbsp;echo <span class="code-str">"$fileName upload is complete"</span>;<br>
	} else {<br>
    &nbsp;&nbsp;&nbsp;echo <span class="code-str">"move_uploaded_file function failed"</span>;<br>
	}<br>
<p class="code-phptags">?&gt;</p>
</code>

<h3 class="coderef">FilesUpload.java</h3>
<code>
<span class="code-phptags">package</span> my.servlet;<br><br>

<span class="code-phptags">import</span> java.io.*;<br>
<span class="code-phptags">import</span> javax.servlet.ServletException;<br>
<span class="code-phptags">import</span> javax.servlet.annotation.MultipartConfig;<br>
<span class="code-phptags">import</span> javax.servlet.annotation.WebServlet;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServlet;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServletRequest;<br>
<span class="code-phptags">import</span> javax.servlet.http.HttpServletResponse;<br>
<span class="code-phptags">import</span> javax.servlet.http.Part;<br><br>


<span class="code-comment">@WebServlet</span>(<span class="code-phptags">name = <span class="code-str">"FilesUpload"</span>, urlPatterns = { <span class="code-str">"/filesupload"</span> }</span>)<br>
<span class="code-comment">@MultipartConfig</span>(<span class="code-phptags">fileSizeThreshold=<span class="code-str">1024*1024*2</span>, <span class="code-comment">// 2MB</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;maxFileSize=<span class="code-str">1024*1024*10</span>,      <span class="code-comment">// 10MB</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;maxRequestSize=<span class="code-str">1024*1024*50</span>)   <span class="code-comment">// 50MB</span><span><br><br>

<span class="code-phptags">public class</span> FilesUpload <span class="code-phptags">extends</span> HttpServlet {<br>
	 <span class="code-comment">
	&nbsp;&nbsp;&nbsp;/**<br>
    &nbsp;&nbsp;&nbsp;* Name of the directory where uploaded files will be saved, relative to<br>
    &nbsp;&nbsp;&nbsp;* the web application directory.<br>
    &nbsp;&nbsp;&nbsp;*/
	</span><br>
    <span class="code-phptags">&nbsp;&nbsp;&nbsp;private static final</span> String <span class="code-elem">SAVE_DIR = "uploadFiles"</span>;<br><br>
     
    <span class="code-comment">
	&nbsp;&nbsp;&nbsp;/**<br>
    &nbsp;&nbsp;&nbsp;* handles file upload<br>
    &nbsp;&nbsp;&nbsp;*/
	</span><br>
    <span class="code-phptags">&nbsp;&nbsp;&nbsp;protected void</span> doPost(HttpServletRequest request,<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HttpServletResponse response) <span class="code-phptags">throws</span> ServletException, IOException {<br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// gets absolute path of the web application to the WEB-INF folder</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String appPath = request.getServletContext().getRealPath(<span class="code-comment">"/WEB-INF"</span>);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// constructs path of the directory to save uploaded file</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String savePath = appPath + File.separator + <span class="code-elem">SAVE_DIR</span>;<br><br>
         
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// create the save directory if it does not exist</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;File fileSaveDir = new File(savePath);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (!fileSaveDir.exists()) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fileSaveDir.mkdir();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String fileName = "";<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for (Part part : request.getParts()) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fileName = extractFileName(part);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// refines the fileName in case it is an absolute path</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fileName = new File(fileName).getName();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;part.write(savePath + File.separator + fileName);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-comment">// The directive is going to show us the path to a file, where it has been saved<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// Using for a develop purpose</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;System.out.println(savePath + File.separator + fileName);<br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PrintWriter out = response.getWriter();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;out.print(fileName+<span class="code-str">" upload is complete"</span>);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;out.flush();<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;out.close();<br>
    &nbsp;&nbsp;&nbsp;}<br><br>
	
	&nbsp;&nbsp;&nbsp;<span class="code-comment">/**<br>
    &nbsp;&nbsp;&nbsp;* Extracts file name from HTTP header content-disposition<br>
    &nbsp;&nbsp;&nbsp;*/</span><br>
    <span class="code-phptags">&nbsp;&nbsp;&nbsp;private</span> String extractFileName(Part part) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String contentDisp = part.getHeader(<span class="code-str">"content-disposition"</span>);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String[] items = contentDisp.split(<span class="code-str">";"</span>);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for (String s : items) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (s.trim().startsWith(<span class="code-str">"filename"</span>)) {<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return s.substring(s.indexOf("=") + 2, s.length()-1);<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return <span class="code-str">""</span>;<br>
    &nbsp;&nbsp;&nbsp;}<br>

}<br>
</code>