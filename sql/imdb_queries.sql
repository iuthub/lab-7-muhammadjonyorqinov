#1
SELECT * FROM `movies` WHERE `year` = 1995;

#2
SELECT COUNT(*) FROM actors a 
								JOIN roles r ON a.id = r.actor_id
                                JOIN movies m ON m.id = r.movie_id
                                WHERE m.name = "Lost in Translation"

#3
SELECT a.first_name, a.last_name FROM actors a 
								JOIN roles r ON a.id = r.actor_id
                                JOIN movies m ON m.id = r.movie_id
                                WHERE m.name = "Lost in Translation"

#4
SELECT d.first_name, d.last_name FROM `directors` d
								JOIN `movies_directors` md ON d.id = md.director_id
                                JOIN `movies` m ON md.movie_id = m.id
                                WHERE m.name = "Fight Club"

#5
SELECT COUNT(*) FROM `movies` m 
			JOIN `movies_directors` md ON md.movie_id = m.id
            JOIN `directors` d ON d.id = md.director_id
            WHERE d.first_name = "Clint" and d.last_name="Eastwood"          


#6 
SELECT `name` FROM `movies` m 
			JOIN `movies_directors` md ON md.movie_id = m.id
            JOIN `directors` d ON d.id = md.director_id
            WHERE d.first_name = "Clint" and d.last_name="Eastwood"    

#7
SELECT d.first_name, d.last_name FROM `directors` d 
            JOIN `movies_directors` md ON md.director_id = d.id 
            JOIN `movies` m ON m.id = md.movie_id 
            JOIN `movies_genres`mg ON mg.movie_id = m.id 
            WHERE mg.genre = "Horror"

#8
SELECT a.first_name, a.last_name FROM `actors` 
                    JOIN `roles` r ON a.id = r.actor_id
                    JOIN `movies` m ON r.movie_id = m.id
                    JOIN `movies_directors` md ON m.id = md.movie_id
                    JOIN `directors` d ON md.director_id = d.id
                    WHERE d.first_name = "Christopher" and d.last_name = "Nolan"
                                        