<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="utf-8" />
        <title>Home</title>
        <script>
            function getCourses(){
                var databox = document.getElementById("courses");
                var httpReq = new XMLHttpRequest();
                httpReq.open("GET", "getCourses.php", true);
                httpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                httpReq.onreadystatechange = function() {
                    if(httpReq.readyState == 4 && httpReq.status == 200) {
                        var data = JSON.parse(httpReq.responseText);
                        courses.innerHTML = "";
                        var HTML = "<table><tr><th>Id</th><th>Name</th><th>Status</th><th>Created At</th><th>Updated At</th></tr>"
                        for(var index in data.courses){
                            HTML += "<tr>";
                            if(data.courses[index].id){
                                HTML += "<td>" + data.courses[index].id +  "</td>";
                            } 
                            if(data.courses[index].name){
                                HTML += "<td>" + data.courses[index].name +  "</td>";
                            } 
                            if(data.courses[index].status){
                                HTML += "<td>" + data.courses[index].status +  "</td>";
                            }
                            if(data.courses[index].createdAt){
                                HTML += "<td>" + data.courses[index].createdAt +  "</td>";
                            }
                            if(data.courses[index].updatedAt){
                                HTML += "<td>" + data.courses[index].updatedAt +  "</td>";
                            }
                            HTML += "</tr>";
                        }
                        HTML += "</table>";
                        courses.innerHTML = HTML;
                    }
                }
                    
                httpReq.send("limit=4");
            }

            function getCourseID(){
                var databox = document.getElementById("courseIDUpdate");
                var httpReq = new XMLHttpRequest();
                id = document.forms[0].id.value;
                httpReq.open("GET", "getCourseId.php?id=" + id, true);
                httpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                httpReq.onreadystatechange = function() {
                    if(httpReq.readyState == 4 && httpReq.status == 200) {
                        var data = JSON.parse(httpReq.responseText);
                        console.log(data.updatedAt);
                        courseIDUpdate.innerHTML = "";
                        var HTML = "<table><tr><th>Id</th><th>Name</th><th>Status</th><th>Created At</th><th>Updated At</th></tr>"
                        HTML += "<tr>";
                        HTML += "<td>" + data.id +  "</td>";
                        HTML += "<td>" + data.name +  "</td>";
                        HTML += "<td>" + data.status +  "</td>";
                        HTML += "<td>" + data.createdAt +  "</td>";
                        if(data.updatedAt){
                            HTML += "<td>" + data.updatedAt +  "</td>";
                        }
                        HTML += "</tr>";
                        HTML += "</table>";
                        courseIDUpdate.innerHTML = HTML;
                    }
                }
                    
                httpReq.send("limit=4");
            }

            function postCourse(){
                var databox = document.getElementById("newCourseResult");
                var httpReq = new XMLHttpRequest();
                httpReq.open("POST", "postCourses.php", true);
                httpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var data = JSON.stringify({"status": document.getElementById("statusN"),"name": document.getElementById("nameN")});
                console.log(data);
                httpReq.send(data);   
                httpReq.onreadystatechange = function() {
                    if(httpReq.readyState == 4 && httpReq.status == 201) {
                        courseIDUpdate.innerHTML = "<p>Course added</p>"
                    }
                }
            }
        </script>
    </head>
    
    <body>
        <div id="courses">
        </div>
        <div id="courseID">
            <form name="formCourseID" action="#" method="GET" onsubmit="return getCourseID()">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id"/>
                <input type="submit" id="idSub" value="submit"/>
            </form>
            <div id="courseIDUpdate">
            </div>
        </div>
        <div id="newCourse">
            <form name="newCourseForm" action="#" method="GET" onsubmit="return postCourse()">
                <label for="nameN">Name:</label>
                <input type="text" id="nameN" name="nameN"/>
                <label for="statusN">Status:</label>
                <input type="text" id="statusN" name="statusN"/>
                <input type="submit" id="nameSub" value="submit"/>
            </form>
            <div id="newCourseResult">
            </div>
        </div>
        <script>
            getCourses();
        </script>
    </body>
</html>