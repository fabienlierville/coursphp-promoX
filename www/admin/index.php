<?php
require('../inc/header.php');
require ('../inc/config.php');
$requete = $bdd->query('SELECT * FROM articles ');
$articles = $requete->fetchALL(PDO::FETCH_ASSOC);

?>
    <h1>Partie Admin</h1>

    <table>
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Titre</th>
            <th scope="col">DatePublication</th>
            <th scope="col">Auteur</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        <?php
            foreach($articles as $article)
            {
                echo "<tr>";
                    echo "<th scope='row'><a href='#'>{$article["Id"]}</a></th>";
                    echo "<td>{$article["Titre"]}</td>";
                    echo "<td>{$article["DatePublication"]}</td>";
                    echo "<td>{$article["Auteur"]}</td>";
                    echo "<td><a href='#'>&#128465;</a></td>";
                echo "</tr>";
            }
        ?>



        </tbody>
    </table>



<?php require('../inc/footer.php'); ?>