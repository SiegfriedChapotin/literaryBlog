<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 30/01/2019
 * Time: 16:36
 */

namespace LiteraryCore\Service\pearPager;


class PearPager
{

			public function PearPager(){


			// On calcule le nombre de pages et affiche les liens
				$nbCommentairesPages=8;

				$reponse = $bdd->query('SELECT COUNT(*) AS nb_billets FROM salon');//on récupére le contenu de la requête dans $reponse
				$donnees = $reponse->fetch();//On range reponse sous la forme d'un tableau.
				$nb_billets = $donnees['nb_billets'];//On récupère le total pour le placer dans la variable $total

				$nb_pages_entier = ceil($nb_billets/$nbCommentairesPages);


				if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
					{
						 $pageActuelle=intval($_GET['page']);

						 if($pageActuelle>$nb_pages_entier) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nb_pages_entier...
						 {
							  $pageActuelle=$nb_pages_entier;
						 }
					}
				else // Sinon
					{
						 $pageActuelle=1; // La page actuelle est la n°1
					}

				$premiereEntree=($pageActuelle-1)*$nbCommentairesPages; // On calcul la première entrée à lire

			// La requête sql pour récupérer les messages de la page actuelle.

				$retour_messages=$bdd->query('SELECT UPPER(pseudo) AS pseudo_Maj,id,message, DATE_FORMAT(date,  \'%d/%m/%Y à %Hh%imin%ss\') AS date FROM salon ORDER BY id DESC LIMIT '.$premiereEntree.', '.$nbCommentairesPages.'');

					while($donnees_messages=$retour_messages->fetch()){
					echo '<table>
							<tr>
								<td class="cellule1">Par '.htmlspecialchars($donnees_messages['pseudo_Maj']).'</br>
								<a href="modifsalon.php?id='.$donnees_messages['id'].'">Modifier</a></td>
								<td class="celluledate">  le : '.$donnees_messages['date'].'</br>
								<a href="suppsalon.php?id='.$donnees_messages['id'].'">Supprimer</a></td>
							</tr>
							<tr>
								<td colspan="2" class="cellule2">'.nl2br(htmlspecialchars($donnees_messages['message'])).'</td>
							</tr>
							</table>';
							}

				$retour_messages->closeCursor();

				echo '<p align="center"><a>Page : </a>'; //Pour l'affichage, on centre la liste des pages
				for($i=1; $i<=$nb_pages_entier ; $i++) //On fait notre boucle
{
			//On va faire notre condition
				if($i==$pageActuelle) //Si il s'agit de la page actuelle...
				 {
					 echo ' [ '.$i.' ] ';
				 }
				 else //Sinon...
				 {
					  echo ' <a href="laCauserie.php?page='.$i.'">'.$i.'</a> ';
				 }
				}
				echo '</p>';


            }




}