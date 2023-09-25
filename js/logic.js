
document.addEventListener("DOMContentLoaded", function () {
     const input = document.getElementById("autocompleteInput");
     const autocompleteList = document.getElementById("autocompleteList");
    var dataArrayString = $("#data-container").attr("data-array");
    var t = JSON.parse(dataArrayString);
     var options = [];
    t.forEach(
        str => {
            str["name"] = str["name"].replace(/_/g, " ");
            options.push(str)
        })
     function updateAutocompleteList() {
         const searchText = input.value.toLowerCase();
         autocompleteList.innerHTML = "";
         options.forEach(option => {
             if (option["name"].toLowerCase().startsWith(searchText)) {
                 const li = document.createElement("li");
                 li.textContent = option["name"];
                 li.addEventListener("click", () => {
                     input.value = option["name"];
                     autocompleteList.innerHTML = "";
                 });
                 autocompleteList.appendChild(li);
             }
         });

     if (isAutocompleteVisible) {
         autocompleteList.style.display = "block";
     } else {
         autocompleteList.style.display = "none";
     }
 }
 input.addEventListener("click", () => {
     isAutocompleteVisible = true;
     updateAutocompleteList();
 });

 document.addEventListener("click", event => {
     if (!autocompleteList.contains(event.target) && event.target !== input) {
         isAutocompleteVisible = false;
         updateAutocompleteList();
     }
 });
     input.addEventListener("input", updateAutocompleteList);
 });
function add_record()
{
    var name = document.getElementById("autocompleteInput").value;
    var precent = document.getElementById("percentInput").value;
    var video = document.getElementById("videoInput").value;
    console.log(video, precent, name)
    var params = {precent, video, name}
    $.ajax({
        type: "POST",
        url: "/add_record",
        data: params
    }).done(function (msg) {
        console.log(msg);
    })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.error('Ошибка: ' + textStatus, errorThrown);
        });
}
function create_level()
{
    var name = document.getElementById("create_level").value;
    var video = document.getElementById("create_videoInput").value;
    var fps = document.getElementById("create_fps").value;
    var type = document.getElementById("create_type").value;
//    var typeVerify = document.getElementById("typeVerify").value;
    var params = {type, video, fps, name}
/*    $.ajax({
        type: "POST",
        url: "/verify",
        data: params
    }).done(function (msg) {
        location.reload();
        console.log(msg)
})
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.error('Ошибка: ' + textStatus, errorThrown);
        });
*/}
