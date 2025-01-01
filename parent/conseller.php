<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="home_css.css">
    <!-- Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    <!-- jQuery library file -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script>

    <!-- Datatable plugin JS library file -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
    </script>
</head>
<style>
  

    .table_container_class {
        display: flex;
        margin: auto;
        margin-top: 25px;

        justify-content: center;
        align-items: center;
        transition: all 300ms ease;


    }

    td{
        text-transform: uppercase;
    }


    .display {
        border-collapse: collapse;
        margin: 25px 0;
        border-top: 5px;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        width: 70%;
        transition: all 300ms ease;
    }

    .display thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;

    }

    .display th,
    .display td {
        padding: 12px 15px;
    }

    .display tbody tr {
        border-bottom: thin solid #dddddd;
    }

    #checkbox_a {
        display: none;
    }

    .display tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    .display tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }

    tr {
        height: 38px;
    }

    #tableID_filter {
        margin-bottom: 30px;
    }

    #tableID_paginate {
        margin-top: 15px;
    }

    #tableID_filter input {
        width: 400px;
        margin-left: 10px;
        margin-right: 7px;
        border-radius: 5px;
        height: 35px;
        font-size: large;
    }

    #tableID_filter {

        color: #065142;
        font-size: large;
    }

    #tableID_length label {
        color: #065142;
        font-size: large;
    }

    #tableID_length select {
        width: 60px;
        margin-left: 10px;
        margin-right: 7px;
        border-radius: 5px;

    }

    .buttonclass {
        margin: 0 auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        padding: 20px;
        background-color: white !important;
        display: flex;
        justify-content: flex-start;
        margin-left: 14%;
        margin-right: 14%;
        align-items: center;
        margin-top: 60px;
        transition: all 300ms ease;

    }

    .b1 {
        padding: 8px;

        margin-right: 10px;
        background-color: #009879;
        color: white;
        border: none;
        border-radius: 5px;
    }

    .b2 {
        padding: 8px;

        margin-right: 10px;
        background-color: #e43a3a;
        color: white;
        border: none;
        border-radius: 5px;
    }

    .b3 {
        padding: 10px;

        margin-right: 10px;
        background-color: #256be4;
        color: white;
        border: none;
        border-radius: 5px;
        position: relative;
        left: 40%;
    }

    .insertvalues {
        margin: 0 auto;

        padding: 20px;
        display: flex;
        justify-content: flex-start;
        background-color: white !important;
        margin-left: 14%;
        margin-right: 14%;
        margin-top: 5px;
        align-items: flex-start;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        display: none;
        color: black;
        -prefix-animation: slide 1s ease 3.5s forwards;
        


    }
    @-prefix-keyframes slide {
  from {height: 0;}
  to {height: 300px;}
}

    .insertvalues >div{
        display: inline-flex;
        justify-content: flex-start;
        align-items: flex-start;
        margin-top: 10px;
    }
   
    
</style>
<script>

    /* Initialization of datatable */
    $(document).ready(function () {
        $('#tableID').DataTable({
            info: false, aaSorting: [],
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [0] },
                { "bSearchable": false, "aTargets": [0] }
            ]
        });
    });
</script>
<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");

        filter = input.value.toUpperCase();
        table = document.getElementById("tableID");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "block";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function kliendikaartF() {
        var checkBox = document.getElementById("kaartCheck");
        var elms = document.querySelectorAll("[id='checkbox_appearer']");
        console.log(elms)
        if (checkBox.checked == true) {
            for (var i = 0; i < elms.length; i++) {
                elms[i].checked = true;
            }
        } else {
            for (var i = 0; i < elms.length; i++) {
                elms[i].checked = false;
            }
        }
    }
    var count = 0
    function show_dissapear() {
        var elmen = document.querySelectorAll("[id='checkbox_appearer']");
        var elms = document.querySelectorAll("[id='checkbox_a']");
        for (var i = 0; i < elmen.length; i++) {
            elmen[i].checked = false;
        }
        if (count == 0) {
            for (var i = 0; i < elms.length; i++) {

                elms[i].style.display = "block"

            }

            count++
        } else {
            for (var i = 0; i < elms.length; i++) {

                elms[i].style.display = "none"


            }
            count--

        }
    }
    function deleteMoreRows() {
        var elms = document.querySelectorAll("[id='checkbox_appearer']");
        table = document.getElementById('tableID')
        console.log(count)
        if (count != 0) {
            if (confirm("Are you sure you want to delete this record")) {
                for (var i = 0; i < elms.length; i++) {

                    if (elms[i].checked == true) {
                        console.log(i)
                        table.deleteRow(i + 1)
                        elms[i] = elms[i] - 1
                    }




                }
            }
        }


    }
    var state = document.getElementById('txtst')
    var year = document.getElementById('txtyear')
    var students = document.getElementById('txtstudents')
    var schools = document.getElementById('txtschools')
    var dropout = document.getElementById('txtdrop')
    var lit = document.getElementById('txtliteracy')
    var gender = document.getElementById('txtgender')
    divid = document.getElementById('insertvaluesid')

    var newcount = 0
    function addmorevalues() {

        if (newcount == 0) {
            divid.style.display = "block"
            state.value = ""
            year.value = ""
            students.value = ""
            schools.value = ""
            dropout.value = ""
            lit.value = ""
            newcount++
        } else {
            divid.style.display = "none"
            newcount--
        }

    }

    function CreateTable() {

        if (state.value == "" || year.value == "" || students.value == "" || schools.value == "" || dropout.value == "" || lit.value == "") {
            alert("please do not enter null values")

        } else {
            var table = document.getElementById("tableID");
            var row = table.insertRow(2);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var inserter = state.value;
            var tocaser = inserter.toUpperCase(); 
            cell1.innerHTML = tocaser;
            cell2.innerHTML = year.value;
            cell3.innerHTML = students.value;
            cell4.innerHTML = schools.value;
            cell5.innerHTML = dropout.value;
            cell6.innerHTML = lit.value;
            state.value = ""
            year.value = ""
            students.value = ""
            schools.value = ""
            dropout.value = ""
            lit.value = ""
        }




    }
    // function sortbyvalue() {
    //     var select = document.getElementById('state_search');
    //     var text = select.options[select.selectedIndex].text;
    //     var select1 = document.getElementById('year_search');
    //     var text1 =select1.options[select1.selectedIndex].text;
    //     console.log(text1)
        
        
    //     // Declare variables
        
    //     if (text == "none" && text1 == "none"){

    //         for (i = 0; i < tr.length; i++) {
    //         tr[i].style.display ="block"
            
        
    //     }
    

    //     }else if (text1 == "none"){
    //         filter = text.toUpperCase();
    //     table = document.getElementById("tableID");
    //     tr = table.getElementsByTagName("tr");
    //     console.log(filter)

    //     // Loop through all table rows, and hide those who don't match the search query
    //     for (i = 0; i < tr.length; i++) {
    //         td = tr[i].getElementsByTagName("td")[1];
    //         if (td) {
    //             txtValue = td.textContent || td.innerText;
    //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //                 tr[i].style.display = "block";
    //             } else {
    //                 tr[i].style.display = "none";
    //             }
    //         }
    //     }
            
    //     }
    // }
        
        
    

    











</script>
<body>
<div class="container">
        <aside>
            <div class="top">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Parent</b></p>
                        <small class="text-muted"></small>
                    </div>
                    <div class="profile-photo">
                        <img src="profile-2.jpg">
                    </div>
                </div>
                <div id="close-btn" class="close">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
        <div class="sidebar">
            <a href="parent_home.php" >
                <span class="material-icons-sharp">grid_view</span>
                <h3>Home</h3>

            </a>
            <a href="parent_messages.php" >
                <span class="material-icons-sharp">grid_view</span>
                <h3>Messages </h3><span class="message-count">26</span>

            </a>
            <a href="customisatin.php">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Customisation</h3>

            </a>
            <a href="conseller.php" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Account Controls</h3>

            </a>
            <a href="studentsdata.html">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Payement</h3>

            </a>



            <a href="login.html">
                <span class="material-icons-sharp">grid_view</span>
                <h3>logout</h3>

            </a>
        </div>
        

        
    
</aside>
<main>

    <div class="buttonclass">
        <button class="b1" onclick="addmorevalues()"><span style="font-size: 20px;">+</span>&ensp;Add
            Record</button>
        <button class="b2" onclick="deleteMoreRows()"><span style="font-size: 20px;">-</span>&ensp;Delete
            Record</button>
        <button class="b3" style="float: right;" onclick="show_dissapear()"><span
                style="font-size: 20px;">≡</span>&ensp;Edit Table</button>
    </div>
    <p></p>
    <div class="insertvalues" id="insertvaluesid">
        <div>Student ID &ensp;<input type="text" id="txtst" placeholder="enter student ID"></div>
        <div>Name &ensp;<input type="text" id="txtyear" placeholder="enter name"></div>
        <div>age &ensp;<input type="text" id="txtstudents" placeholder="enter age"></div>
        <div>Gender &ensp;<input type="text" id="txtschools" placeholder="enter gender"></div>
        <div>class &ensp;<input type="text" id="txtdrop" placeholder="enter class"></div>
        
        <div> Password&ensp;<input type="text" id="txtgender" placeholder="enter password"></div>
        &nbsp;<input type="button" value=" Add "
            style="float: right;margin-right: 20px;background-color: #009879;color: white;padding: 7px;border-radius: 4px;border: none;"
            onclick="CreateTable()">



    </div>
    <div class="table_container_class">



        <!--HTML table with student data-->
        <div class="inner-container">
            <table id="tableID" class="display" style="width:100%">
                <thead>
                    <tr>
                        <td id="checkbox_a" class="inner_checkbox">
                            <div><input type="checkbox" id="checkbox_appearer"></div>
                        </td>
                        <th>Student ID </th>
                        <th>Name</th>
                        <th>age</th>
                        <th>Gender</th>
                        <th>class</th>
                        
                        <th>Password</th>
            
                    </tr>
                </thead>   
                <tbody>
                    <tr>
                        <td id="checkbox_a" class="inner_checkbox">
                            <div><input type="checkbox" id="checkbox_appearer"></div>
                        </td>
                        <td> 1234 5678 9876 9877 </td>
                        <td>sri</td>
                        <td>14</td>
                        <td>Male</td>
                        <td>9th</td>
                        
                        <td>Password123</td>
                    </tr>
                    <tr>
                        <td id="checkbox_a" class="inner_checkbox">
                            <div><input type="checkbox" id="checkbox_appearer"></div>
                        </td>
                        <td> 9512 5678 9876 9877 </td>
                        <td>kumar</td>
                        <td>10</td>
                        <td>Male</td>
                        <td>5th</td>
                        
                        <td>Password123</td>
                    </tr>
                    
                </tbody> 
    
                
                </table>
        </div>
    </div>  
    <div></div>
    
   
</main>
<div class="right">
    <div class="top">
        <button id="menu-btn">
            <span class="material-icons-sharp">menu</span>
        </button>
        <div class="theme-toggler" id="themeToggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
        </div>
        

    </div>
 <!-- ============top===== -->
 <div class="recent-updates">
                <h2>Recent updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="p.jpeg">
                        </div>
                        <div class="message">
                            <p><b></b>Parent Controls</p>
                                    <small class="text-muted">A parent can monitor his/her child's activity, track their progress, and view their milestones within the application.
                                    </small>
                                    <small class="text-muted"></small>
                        </div>
                        
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="p.jpeg">
                        </div>
                        <div class="message">
                            <p><b></b>Content Exploration</p>
                                    <small class="text-muted">Child can access the content according to his course.</small>
                                    <small class="text-muted"></small>
                        </div>
                        
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="p.jpeg">
                        </div>
                        <div class="message">
                            <p><b></b>Quizzes and Rewards</p>
                            <small class="text-muted">Child can take Quizes and get rewarded with in app coins based on his score.</small>
                            <small class="text-muted"></small>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="sales-analytics">
                    <h2>Upcoming Updates</h2>
                    <div class="item online">
                        <div class="icon"></div>
                        <span class="material-symbols-sharp">
                            schedule
                            </span>
                        <div class="right">
                            <div class="info">
                                <h3>Parent Controls</h3>
                                <small class="text-muted">Parent can set specific screen time limits and breaks to foster healthy usage habits for his/her child.

                                </small>
                            </div>
                            <h5 class="success"></h5>
                            <h3></h3>
                        </div>
                    </div>
                    
        
        
        
        
        
                    <div class="item offline">
                        <div class="icon"></div>
                        <span class="material-symbols-sharp">
                            cast_for_education
                            </span>
                        <div class="right">
                            <div class="info">
                                <h3>Quizes and Rewards</h3>
                                <small class="text-muted">Child can redeem some goodies with the coins he achived.</small>
                            </div>
                            <h5 class="danger"></h5>
                            <h3></h3>
                        </div> 
                    </div>
                    
                    
        
        
        
                    
        
        
                </div>
                
            </div>
        </div>

    </div>
    </div>

<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");

        filter = input.value.toUpperCase();
        table = document.getElementById("tableID");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "block";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function kliendikaartF() {
        var checkBox = document.getElementById("kaartCheck");
        var elms = document.querySelectorAll("[id='checkbox_appearer']");
        console.log(elms)
        if (checkBox.checked == true) {
            for (var i = 0; i < elms.length; i++) {
                elms[i].checked = true;
            }
        } else {
            for (var i = 0; i < elms.length; i++) {
                elms[i].checked = false;
            }
        }
    }
    var kingcount = 0
    function show_dissapear() {
        var elmen = document.querySelectorAll("[id='checkbox_appearer']");
        var elms = document.querySelectorAll("[id='checkbox_a']");
        for (var i = 0; i < elmen.length; i++) {
            elmen[i].checked = false;
        }
        if (kingcount == 0) {
            for (var i = 0; i < elms.length; i++) {

                elms[i].style.display = "block"

            }

            kingcount++
        } else {
            for (var i = 0; i < elms.length; i++) {

                elms[i].style.display = "none"


            }
            kingcount--

        }
    }
    function deleteMoreRows() {
        var elms = document.querySelectorAll("[id='checkbox_appearer']");
        table = document.getElementById('tableID')
        console.log(kingcount)
        if (kingcount != 0) {
            if (confirm("Are you sure you want to delete this record")) {
                for (var i = 0; i < elms.length; i++) {

                    if (elms[i].checked == true) {
                        console.log(i)
                        table.deleteRow(i + 1)
                        
                    }




                }
            }
        }


    }
    var state = document.getElementById('txtst')
    var year = document.getElementById('txtyear')
    var students = document.getElementById('txtstudents')
    var schools = document.getElementById('txtschools')
    var dropout = document.getElementById('txtdrop')
    var lit = document.getElementById('txtliteracy')
    var gender = document.getElementById('txtgender')
    divid = document.getElementById('insertvaluesid')

    var newkingcount = 0
    function addmorevalues() {

        if (newkingcount == 0) {
            setTimeout(1000)
            divid.style.display = "block"
            state.value = ""
            year.value = ""
            students.value = ""
            schools.value = ""
            dropout.value = ""
            lit.value = ""
            newkingcount++
        } else {
            setTimeout(1000)
            divid.style.display = "none"
            newkingcount--
        }

    }

    function CreateTable() {

        if (state.value == "" || year.value == "" || students.value == "" || schools.value == "" || dropout.value == "" || lit.value == "" || gender.value == "") {
            alert("please do not enter null values")

        } else {
            var table = document.getElementById("tableID");
            var row = table.insertRow(2);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var inserter = state.value;
            var tocaser = inserter.toUpperCase(); 
            cell1.innerHTML = tocaser;
            cell2.innerHTML = year.value;
            cell3.innerHTML = students.value;
            cell4.innerHTML = schools.value;
            cell5.innerHTML = dropout.value;
            cell6.innerHTML = lit.value;
            cell7.innerHTML = gender.value;
            state.value = ""
            year.value = ""
            students.value = ""
            schools.value = ""
            dropout.value = ""
            lit.value = ""
            gender.value="  "
        }




    }
    // function sortbyvalue() {
    //     var select = document.getElementById('state_search');
    //     var text = select.options[select.selectedIndex].text;
    //     var select1 = document.getElementById('year_search');
    //     var text1 =select1.options[select1.selectedIndex].text;
    //     console.log(text1)
        
        
    //     // Declare variables
        
    //     if (text == "none" && text1 == "none"){

    //         for (i = 0; i < tr.length; i++) {
    //         tr[i].style.display ="block"
            
        
    //     }
    

    //     }else if (text1 == "none"){
    //         filter = text.toUpperCase();
    //     table = document.getElementById("tableID");
    //     tr = table.getElementsByTagName("tr");
    //     console.log(filter)

    //     // Loop through all table rows, and hide those who don't match the search query
    //     for (i = 0; i < tr.length; i++) {
    //         td = tr[i].getElementsByTagName("td")[1];
    //         if (td) {
    //             txtValue = td.textContent || td.innerText;
    //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //                 tr[i].style.display = "block";
    //             } else {
    //                 tr[i].style.display = "none";
    //             }
    //         }
    //     }
            
    //     }
    // }
        
        
    

    











</script>

</body>
</html>