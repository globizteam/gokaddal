<a href="mapp://52.14.191.81/newsapp/admin" style="font-size: 30px;" id="myCheck" >Redirect</a>
<script>
  (function() {
  var app = {
    launchApp: function() {
      window.location.replace("mapp://52.14.191.81/newsapp/admin");
	document.getElementById("myCheck").click(); 
      this.timer = setTimeout(this.openWebApp, 1000);
    },

    openWebApp: function() {
       window.location.replace("http://itunesstorelink/");
    }
  };

  app.launchApp();
})();
</script>