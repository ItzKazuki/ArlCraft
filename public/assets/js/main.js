// This is for the click to copy
let t;
$(document).ready(()=>{
	t = $(".ip").html();
})
$(document).on("click",".ip",()=>{
	let copy = document.createElement("textarea");
	copy.style.position = "absolute";
	copy.style.left = "-99999px";
	copy.style.top = "0";
	copy.setAttribute("id", "ta");
	document.body.appendChild(copy);
	copy.textContent = t;
	copy.select();
	document.execCommand("copy");
	$(".ip").html("<span class='extrapad'>IP copied!</span>");
	setTimeout(function(){
		$(".ip").html(t);
		var copy = document.getElementById("ta");
		copy.parentNode.removeChild(copy);
	},800);
});

// This is to fetch the player count
$(document).ready(()=>{
  const ip = $(".sip").attr("data-ip");
  const jenis = $(".sip").attr("data-jenis");

  $.get(`https://api.mcstatus.io/status/${jenis}/${ip}`, (result)=>{
    if (result.response) {
      $(".sip").html(result.response.online_players);
    } else {
      $(".playercount").html("Server isn't online!");
    }
  });

  setInterval(()=>{
    $.get(`https://api.mcstatus.io/status/${jenis}/${ip}`, (result)=>{
      if (result.response) {
        $(".sip").html(result.response.online_players);
      } else {
        $(".playercount").html("Server isn't online!");
      }
    });
  }, 500);
});
