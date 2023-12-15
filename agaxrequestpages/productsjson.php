<h2 class="titlecodes">JSON Ajax Post Dynamic Variable Data PHP, JAVA</h2>

<p class="descriptioncode">
In this part of the JSON programming I extend the dynamics from 
the last example by changing get Ajax request to a post Ajax request. 
It opens up more dynamic possibilities for JSON data requesting by 
allowing dynamic variable data to be posted to the PHP script or Servlet 
that are going to render the JSON data. 
One could use the posted variable data in a database query 
to fetch specific data to return to the program in JSON format.
</p>

<h3 class="coderef">my_json_list_products.php</h3>
<code>
	<p class="code-phptags">&lt;?php</p>
	<strong>header(<span class="code-str">"Content-Type: application/json"</span>);</strong><br>
	$category = $_POST[<span class="code-str">"category"</span>];<br>
	$pdo = "";<br>
	try<br>
	{<br>
		&nbsp;&nbsp;&nbsp;$pdo = new PDO('mysql:host=localhost;dbname=produk', 'root', '');<br>

	}<br>
	catch (PDOException $e)<br> 
	{<br>
		&nbsp;&nbsp;&nbsp;log_exception($e->getMessage());<br>
	}<br>
	$sql = <span class="code-str">"SELECT* FROM `products` WHERE `category` = ? ORDER BY `price`"</span>;<br>
	$query = $pdo->prepare($sql);<br>
	$query->bindValue(1,$category);<br>
	$query->execute();<br>
	$products = $query->fetchAll(<span class="code-phptags">PDO::FETCH_OBJ</span>);<br>
	$pdo = null;<br>
	echo json_encode($products);<br>
	<p class="code-phptags">?&gt;</p>
</code>

<h3 class="coderef">ProductController.java</h3>
<code>
	<span class="code-phptags">package</span> controller;<br>
	..........<br>
	..........<br>
	<span class="code-phptags">import</span> model.*;<br><br>
	
	<span class="code-comment">@WebServlet</span>(<span class="code-elem">"/jsonlistproducts"</span>)<br>
	<span class="code-phptags">public class</span> ProductController <span class="code-phptags">extends</span> HttpServlet{<br>
	..........<br>
	..........<br>
	&nbsp;&nbsp;&nbsp;<span class="code-comment">@Override</span><br>
	&nbsp;&nbsp;&nbsp;<span class="code-phptags">protected void</span> doPost(HttpSevletRequest <span class="code-phptags">request</span>, HttpServletResponse <span class="code-phptags">response</span>)<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-phptags">throws</span> ServletExseption, IOException{<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PrintWriter out = response.getWriter();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gson <span class="code-brown">gson</span> = <span class="code-phptags">new</span> Gson();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;String <span class="code-brown">category</span> = request.getParameter(<span class="code-elem">"category"</span>);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ArrayList&lt;Product&gt; <span class="code-brown">products</span> = Products.getProductsByCategoryId(category);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-brown">out</span>.print(<span class="code-brown">gson</span>.toJson(products));<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-brown">out</span>.flush();<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-brown">out</span>.close();<br>
	&nbsp;&nbsp;&nbsp;}<br>
	..........<br>
	..........<br>
	}
</code>

<h3 class="coderef">json_products.html</h3>
<code>
	<p class="code-elem">&lt;script&gt;</p>
	function getListProductsByCategoryId(category){<br>
	&nbsp;&nbsp;&nbsp;var products = document.getElementById(<span class="code-str">"products"</span>);<br>
	&nbsp;&nbsp;&nbsp;var htmlproducts = <span class="code-str">""</span>;<br>
	&nbsp;&nbsp;&nbsp;var hr = new XMLHttpRequest();<br>
	<p class="code-comment">&nbsp;&nbsp;&nbsp;// You can use open method that calls PHP script</p>
	&nbsp;&nbsp;&nbsp;hr.open(<span class="code-str">"POST"</span>, <span class="code-str">"my_json_list_products.php"</span>, true);<br>
	<p class="code-comment">&nbsp;&nbsp;&nbsp;// or JAVA Servlet</p>
	&nbsp;&nbsp;&nbsp;hr.open(<span class="code-str">"POST"</span>, <span class="code-str">"jsonlistproducts"</span>, true);<br>
	&nbsp;&nbsp;&nbsp;hr.setRequestHeader(<span class="code-str">"Content-type"</span>, <span class="code-str">"application/x-www-form-urlencoded"</span>);<br>
    &nbsp;&nbsp;&nbsp;hr.onreadystatechange = function() {<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(hr.readyState == 4 && hr.status == 200) {<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var objson = JSON.parse(hr.responseText);<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for(var product in objson){<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;htmlproducts += <span class="code-str">"&lt;p&gt;"</span>+objson[product].name+<span class="code-str">"&lt;/p&gt;"</span>;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;htmlproducts += <span class="code-str">"&lt;img src='media/catalogue/"</span>+objson[product].src+<span class="code-str">"'&gt;"</span>;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;htmlproducts += <span class="code-str">"&lt;p&gt;"</span>+objson[product].price+<span class="code-str">"&lt;/p&gt;"</span>;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;products.innerHTML = htmlproducts;<br>
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
	&nbsp;&nbsp;&nbsp;}<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hr.send(<span class="code-str">"category="</span>+category);<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;products.innerHTML = <span class="code-str">"requesting..."</span>;<br>
	}
	
	<p class="code-elem">&lt;/script&gt;</p>
	<br>
	..........<br>
	..........<br>
	<p class="code-elem">&lt;select <span class="code-alt">name=<span class="code-elem">"category"</span></span> <span class="code-alt">onchange=<span class="code-elem">"getListProductsByCategoryId(this.value)"</span></span>&gt;</p>
		&nbsp;&nbsp;&nbsp;<span class="code-elem">&lt;option <span class="code-alt">value=<span class="code-elem">"1"</span></span>&gt;</span><span class="code-str">Category 1</span><span class="code-elem">&lt;/option&gt;</span><br>
		&nbsp;&nbsp;&nbsp;<span class="code-elem">&lt;option <span class="code-alt">value=<span class="code-elem">"2"</span></span>&gt;</span><span class="code-str">Category 2</span><span class="code-elem">&lt;/option&gt;</span><br>
		&nbsp;&nbsp;&nbsp;.........<br>
		&nbsp;&nbsp;&nbsp;.........<br>
	<p class="code-elem">&lt;/select&gt;</p>
	..........
	<p class="code-elem">&lt;div <span class="code-alt">id=<span class="code-elem">"products"</span></span>&gt;</p>
	&nbsp;&nbsp;&nbsp;..........<br>
	&nbsp;&nbsp;&nbsp;..........
	<p class="code-elem">&lt;/div&gt;</p>
	........
</code>