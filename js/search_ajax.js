function suggestNear(location) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        document.getElementById("NearYou").innerHTML = this.responseText;
        document.getElementById("Results").innerHTML = "<br><h2 class='app-header' id='NearYouHeader'><strong>Quick Search Results: </strong></h2>";
    }
    xmlhttp.open("GET", "./php/search_ajax.php?type=suggest_near&loc=" + location);
    xmlhttp.send();
}