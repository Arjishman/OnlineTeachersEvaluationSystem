
getDate();
evaluationStatus();


function evaluationStatus() {
// Get the modal
    var modal = document.getElementById("myModal");

// Get the button that opens the modal
    var btn = document.getElementById("submit-status");
    var btn1 = document.getElementById("submit-status1");

// When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
        document.getElementById("evaluated").style.display = "";
        document.getElementsByTagName("p")[0].innerHTML="<b>Open For Evaluation</b>";
    }

    btn1.onclick = function(){
        modal.style.display = "block";
        document.getElementById("evaluated").style.display = "none";
        document.getElementsByTagName("p")[0].innerHTML="<b>Evaluated</b>";

    }


// When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}


function getDate() {
    var date = new Date();
    var d = document.getElementById('date1');
    d.value = date.getDay()+'/'+date.getMonth()+'/'+date.getFullYear();
}
