function initializePage() {
    // Hide the profile-edit section on page load
    document.getElementById("profile-edit").style.display = "none";
}
function userposts(){
    document.getElementById("user-posts").style.display="block";
    document.getElementById("profile-edit").style.display="none";
    

}

function profileedit(){
    document.getElementById("user-posts").style.display="none";
    document.getElementById("profile-edit").style.display="block";

}

