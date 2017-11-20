function testConnection(){
	var host,user,pass,database;

	host = document.getElementById("dbhost").value;
	user = document.getElementById("dbuser").value;
	pass = document.getElementById("dbpass").value;
	database = document.getElementById("dbdatabase").value;
	var output = document.getElementById("testResult");
	var button = document.getElementById("sqlsetup-forward-button");
	var link = document.getElementById("sqlsetup-forward-link");
	if(host == "" || user == "" || pass == "" || database == ""){
		button.className = "disabled-button";
		link.removeAttribute("href");
		output.innerHTML = "";
		return;
	}
		
	button.className = "disabled-button";
	link.removeAttribute("href");
	output.innerHTML = "";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(this.response == "connected"){
				output.innerHTML = "Connection Established";
				output.className = "dbconnect";
				installSession(host, user, pass, database);
			}
			else {
				button.className = "disabled-button";
				link.removeAttribute("href");
				output.innerHTML = "Database connection error. Please check your credentials";
				output.className = "dbfail";
			}
		}
	}
	xhttp.open("POST", "db.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("verify=true&host=" + host + "&user=" + user + "&pass=" + pass + "&database=" + database);
}

function installSession(host, user, pass, database){
	var button = document.getElementById("sqlsetup-forward-button");
	var link = document.getElementById("sqlsetup-forward-link");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(this.response == "done") {

				button.className = "forward-button";
				link.href="./?progress=config";//Change the link on the sqlsetup page
			}
			else {
				link.href = null;
				button.className = "disabled-button";
				console.log("an error has occured");
				console.log(this.response);
			}
		}
	}
	xhttp.open("POST", "db.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("startsession=true&host=" + host + "&user=" + user + "&pass=" + pass + "&database=" + database);
}
