$(document).ready(function() {
    // Cambia el color del item del navbar para indicar en cual se está
    let pageName=$("#page").val();
    document.getElementById("page_nav_"+pageName).classList.add("text-success");

    let parent = document.getElementById("page_nav_"+pageName).parentElement;
    document.getElementById(parent.id).classList.add("active");
    let c = parent.children[1];
    c.style.display="block";

    let subName=$("#sub").val();
    document.getElementById(subName).classList.add("text-success");
});
