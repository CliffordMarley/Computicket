<div class="ui page dimmer">
  <div class="content">
    <center>
		<div class="ui image">
			<img src="../../assets/img/loader.gif" alt="">
		</div>
		<h3 id="load_text"></h3>
	</center>
  </div>
</div>
<script>
	function loading(action,txt){
	 $("#load_text").html(txt);
     $('.ui.page.dimmer').dimmer(action);
	}
</script>