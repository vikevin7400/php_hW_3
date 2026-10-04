<?php
include "db.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conn->prepare("select * from projects where id =?");
    $sql->bind_param("i",$id);
    $sql->execute();
    $proj = $sql->get_result()->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $project_name = $_POST["pname"];
    $description = $_POST["desc"];
    $status = $_POST["status"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    $sql = $conn->prepare("update projects set project_name=?, project_description=?, status=?, start_date=?, end_date=? where id=?");

    $sql->bind_param("sssssi",$project_name,$description,$status,$start_date,$end_date,$id);

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
                                <a class="nav-link active" href="home.php" aria-current="page"
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
                            value="<?=$proj["project_name"] ?>"
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
                            value="<?=$proj["project_description"] ?>"
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
                            <option selected disabled value="<?=$proj["status"] ?>">Select one</option>
                            <option value="pending" <?= ($proj["status"] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="in-progress" <?= ($proj["status"] ?? '') === 'in-progress' ? 'selected' : '' ?>>In Progress</option>
                            <option value="completed" <?= ($proj["status"] ?? '') === 'completed' ? 'selected' : '' ?>>Completed</option>
    
                        </select>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="start_date"
                            id="formId1"
                            value="<?=$proj["start_date"] ?>"
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
                            value="<?=$proj["end_date"] ?>"
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