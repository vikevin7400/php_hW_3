<?php

include "db.php";
$result = $conn->query("select * from projects");
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $project_name = $_POST["pname"];
    $description = $_POST["desc"];
    $status = $_POST["status"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    $sql = $conn->prepare("insert into projects(project_name, project_description, status, start_date, end_date)VALUES (?, ?, ?, ?, ?)");

    $sql->bind_param("sssss",$project_name,$description,$status,$start_date,$end_date);

    if ($sql->execute()) {
        header("location:home.php");
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <nav
                class="navbar navbar-expand-sm navbar-light bg-light"
            >
                <div class="container">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button
                        class="navbar-toggler d-lg-none"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavId"
                        aria-controls="collapsibleNavId"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" aria-current="page"
                                    >Home
                                    <span class="visually-hidden">(current)</span></a
                                >
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="dropdownId"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    >Dropdown</a
                                >
                                <div
                                    class="dropdown-menu"
                                    aria-labelledby="dropdownId"
                                >
                                    <a class="dropdown-item" href="#"
                                        >Action 1</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        >Action 2</a
                                    >
                                </div>
                            </li>
                        </ul>
                        <form class="d-flex my-2 my-lg-0">
                            <input
                                class="form-control me-sm-2"
                                type="text"
                                placeholder="Search"
                            />
                            <button
                                class="btn btn-outline-success my-2 my-sm-0"
                                type="submit"
                            >
                                Search
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            
        </header>
        <main>
            <h2 class="text-center my-3">Welcome<?=$_SESSION["uname"] ?></h2>
            <h2 class="text-center my-3">Add Project</h2>
            <div
                class="container col-5 border shadow rounded p-3"
            >
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="pname"
                            id="formId1"
                            placeholder=""
                        />
                        <label for="formId1">Project Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="desc"
                            id="formId1"
                            placeholder=""
                        />
                        <label for="formId1">Description</label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select
                            class="form-select form-select-lg"
                            name="status"
                            id=""
                        >
                            <option selected disabled>Select one</option>
                            <option value="pending">Pending</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="start_date"
                            id="formId1"
                            placeholder="yyyy-mm-dd"
                        />
                        <label for="formId1">Start Date</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="end_date"
                            id="formId1"
                            placeholder="yyyy-mm-dd"
                        />
                        <label for="formId1">End Date</label>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Submit
                    </button>
                    
                </form>
            </div>

            <div
                class="container"
            >
                <div
                    class="table-responsive"
                >
                    <table
                        class="table table-primary"
                    >
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">project name</th>
                                <th scope="col">project description</th>
                                <th scope="col">status</th>
                                <th scope="col">start date</th>
                                <th scope="col">end date</th>
                                <th scope="col">Action</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) {?>
                            <tr class="">
                                <td scope="row"><?= $row["id"]?></td>
                                <td><?= $row["project_name"]?></td>
                                <td><?= $row["project_description"]?></td>
                                <td><?= $row["status"]?></td>
                                <td><?= $row["start_date"]?></td>
                                <td><?= $row["end_date"]?></td>
                                <td> <a
                                    name=""
                                    id=""
                                    class="btn btn-primary"
                                    href="update.php?id=<?=$row["id"]?>"
                                    role="button"
                    
                                    >edit</a
                                >
                                </td>
                                <td> <a
                                    name=""
                                    id=""
                                    class="btn btn-primary"
                                    href="delete.php?id=<?=$row["id"]?>"
                                    role="button"
                                    >delete</a
                                >
                                </td>
                            </tr>
<?php }?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            
            
            <a href="logout.php"><h2 class="text-center">Logout</h2></a>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
