function suggestNear(location) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        document.getElementById("NearYou").innerHTML = this.responseText;
        document.getElementById("NearYouHeader").innerHTML = "<strong>Wagwan Near You</strong>";
    }
    xmlhttp.open("GET", "./php/search_ajax.php?type=suggest_near&loc=" + location);
    xmlhttp.send();
}