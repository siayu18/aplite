<?php
require_once "../../../backend/auth/session_admin.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/profile.css">
    <title>Account Table</title>
</head>
<body>
   <?php include '../../component/admin_header.php'; ?>
   <div class="wrapper">
       <div class="profile-header">
            <h1 class="green-title">Manage Users</h1>
            <p class="green-description">Make changes to user information with 1 click</p>
       </div> 

        <div class="top-group">
            <div class="search-bar">
                <input type="text" placeholder="Search">
                <select>
                    <option>Filter roles</option>
                    <option>Lecturer</option>
                    <option>Admin</option>
                    <option>Student</option>
                    <option>Staff</option>
                </select>
            </div>
            <div class="add-user">
                <button class="big-green-button">
                    <div class="icon-text-3">
                        <img src="../../image/add-user.svg" alt="add-user" class="add-icon">
                        <span>Add User</span>
                    </div>
                </button>
            </div>
        </div>
       <div class="desktop-table">
           <table>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Points</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>
                    <div class="icon-text-2-left">
                        <img src="../../image/profile-3.png" alt="Edit" class="icon-name">
                        <span>Darren Wong</span>
                    </div>
                </td>
                <td>hentai-enjoyer17@gmail.com</td>
                <td>Lecturer</td>
                <td>40</td>
                <td>
                    <div class="btn-group">
                        <button class="border-button">
                            <div class="icon-text-2">
                                <img src="../../image/pencil.svg" alt="Edit" class="icon-buttons">
                                <span>Edit</span>
                            </div>
                        </button>
                        <button class="red-border-button">
                            <div class="icon-text-2">
                                <img src="../../image/trash.svg" alt="Delete" class="icon-buttons">
                                <span>Delete</span>
                            </div>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="icon-text-2-left">
                        <img src="../../image/profile-3.png" alt="Edit" class="icon-name">
                        <span>Haojerh</span>
                    </div>
                </td>
                <td>OOPconcepts@gmail.com</td>
                <td>Staff</td>
                <td>30</td>
                <td>
                    <div class="btn-group">
                        <button class="border-button">
                            <div class="icon-text-2">
                                <img src="../../image/pencil.svg" alt="Edit" class="icon-buttons">
                                <span>Edit</span>
                            </div>
                        </button>
                        <button class="red-border-button">
                            <div class="icon-text-2">
                                <img src="../../image/trash.svg" alt="Delete" class="icon-buttons">
                                <span>Delete</span>
                            </div>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="icon-text-2-left">
                        <img src="../../image/profile-3.png" alt="Edit" class="icon-name">
                        <span>Haojerh</span>
                    </div>
                </td>
                <td>hentai-enjoyer17@gmail.com</td>
                <td>Lecturer</td>
                <td>40</td>
                <td>
                    <div class="btn-group">
                        <button class="border-button">
                            <div class="icon-text-2">
                                <img src="../../image/pencil.svg" alt="Edit" class="icon-buttons">
                                <span>Edit</span>
                            </div>
                        </button>
                        <button class="red-border-button">
                            <div class="icon-text-2">
                                <img src="../../image/trash.svg" alt="Delete" class="icon-buttons">
                                <span>Delete</span>
                            </div>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="icon-text-2-left">
                        <img src="../../image/profile-3.png" alt="Edit" class="icon-name">
                        <span>Haojerh</span>
                    </div>
                </td>
                <td>hentai-enjoyer17@gmail.com</td>
                <td>Lecturer</td>
                <td>40</td>
                <td>
                    <div class="btn-group">
                        <button class="border-button">
                            <div class="icon-text-2">
                                <img src="../../image/pencil.svg" alt="Edit" class="icon-buttons">
                                <span>Edit</span>
                            </div>
                        </button>
                        <button class="red-border-button">
                            <div class="icon-text-2">
                                <img src="../../image/trash.svg" alt="Delete" class="icon-buttons">
                                <span>Delete</span>
                            </div>
                        </button>
                    </div>
                </td>
            </tr>
           </table>
       </div>

       <div class="mobile-list">
            <table>
            <tr>
                <th>User</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>
                    <div class="icon-text-2-left">
                        <img src="../../image/profile-3.png" alt="Edit" class="icon-name">
                        <span>Darren Wong</span>
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <button class="border-button">
                            <div class="icon-text-2">
                                <img src="../../image/pencil.svg" alt="Edit" class="icon-buttons">
                            </div>
                        </button>
                        <button class="red-border-button">
                            <div class="icon-text-2">
                                <img src="../../image/trash.svg" alt="Delete" class="icon-buttons">
                            </div>
                        </button>
                    </div>
                </td>
            </tr>
            </table>
       </div>

       <div class="pagination">
            <button class="page-btn prev">Previous</button>

            <div class="page-numbers">
                <!-- numbers will be inserted dynamically -->
            </div>

            <button class="page-btn next">Next</button>
        </div>
   </div>
   <?php include '../../component/footer.php'; ?>
</body>
</html>