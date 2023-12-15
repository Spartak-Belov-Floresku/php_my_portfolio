<?php require_once('header.php'); ?>

<div id="contact" class="firstdiv">
	<div id="contactcontent">
		<h1>Contact</h1>

		<form autocomplete="off">
			
			<input type="hidden" name="antibot1" id="antibot1" />
			
			<p>
				<label for="username" data-type="name" class="icon-user" id="perusername"> Name
					<span class="required">*</span>
				</label>
				<input type="text" name="username" id="username" placeholder="Your Name" />
			</p>

			
			<p>
				<label for="usermail" data-type="e-mail address" class="icon-envelope"> E-mail address
					<span class="required">*</span>
				</label>
				<input type="email" name="usermail" id="usermail" placeholder="I promise I hate spam too!" />
			</p>

			
			<p>
				<label for="userphone" data-type="phone" class="icon-phone"> Phone</label>
				<input type="phone" name="userphone" id="userphone" placeholder="eg: 888-888-8888"/>
			</p>
			
			
			<div class="subject">
				<label for="subject" class="icon-bullhorn"> Subject</label>
				<div class="selectdrop">
					<select name="subject" id="subject">
						<option value="1">General request</option>
						<option value="2">E-commerce</option>
						<option value="3">Presentation site</option>
					 </select>
				</div>
			</div>

			
			<p>
				<label for="textarea" data-type="message" class="icon-comment"> Message
					<span class="required">*</span>
				</label>
				<textarea placeholder="Your message here and I'll answer as soon as possible " id="textarea"></textarea>
				<span id="counter">500</span>
			</p>
			
			<p class="indication">Fields with<span class="required"> * </span>are required</p>

			<input type="submit" id="buttonsubmit" value=" Send this mail ! " onclick="sendEmail(event)" />
			
			<div class="clear"></div>

		</form>
		<div id="sending"></div>
	</div>
</div>
<?php require_once('footer.php'); ?>