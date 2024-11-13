function toggleMenu() {
                                                        const menuOptions = document.getElementById("menu-options");
                                                        menuOptions.style.display = menuOptions.style.display === "block" ? "none" : "block";
                                                    }

                                                    function openPopup() {
                                                        document.getElementById("popup").style.display = "block";
                                                        document.querySelector(".overlay").style.display = "block";
                                                        document.getElementById("menu-options").style.display = "none";
                                                    }

                                                    function closePopup() {
                                                        document.getElementById("popup").style.display = "none";
                                                        document.querySelector(".overlay").style.display = "none";
                                                    }

                                                    function goToDetail() {
                                                        alert("Menuju halaman detail buku...");
                                                        document.getElementById("menu-options").style.display = "none";
                                                    }

                                                    window.onclick = function (event) {
                                                        const menuOptions = document.getElementById("menu-options");
                                                        if (!event.target.matches('.menu') && !menuOptions.contains(event.target)) {
                                                            menuOptions.style.display = "none";
                                                        }
                                                    }