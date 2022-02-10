CREATE TABLE IF NOT EXISTS `User`(
    username VARCHAR(255) not NULL ,
    user_role ENUM('Artist','Admin','Client') not NULL,
    user_password VARCHAR(255) not NULL,
    PRIMARY KEY(`username`,`user_role`),
    UNIQUE(`username`)

);

CREATE TABLE IF NOT EXISTS `Art`(
    art_link VARCHAR(255) not NULL,
    art_name VARCHAR(255),
    art_artist VARCHAR(255) not NULL,
    art_owner VARCHAR(255) not NULL,
    price INT ,
    PRIMARY KEY(`art_link`),
    FOREIGN KEY (`art_artist`) REFERENCES User (`username`),
    FOREIGN KEY (`art_owner`) REFERENCES User (`username`) ON UPDATE CASCADE,
    UNIQUE(`art_link`)
);


INSERT INTO `User` (`username`, `user_role`, `user_password`) VALUES
('aldi123', 'Artist', '$2y$10$9Rroa.uj6Fh47EJNdwcjEeV1ivoDtFFU1jmfJyUUoZz2aC9f3NvHi'),
('amardo_osmani', 'Artist', '$2y$10$8onxEC1dmJVVMPBtYHedSercbKY3L6YSunlJupqRM5RD8EtS/XOTW'),
('Artan_Hoxha', 'Admin', '$2y$10$/OGgUYcatkizRERyu7lhVe5DfoZcfuWN9/7.8wenV7aiomIfugram'),
('eridon_cuni', 'Client', '$2y$10$.0DJnFEZmq43p4/xf4wlEOehJiQ20g6vRDCUO2HBLPkJ3es/Dqlva');

INSERT INTO `Art` (`art_link`, `art_name`, `art_artist`, `art_owner`, `price`) VALUES
('https://images.unsplash.com/photo-1526642295339-99f8b88a241b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDR8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60', 'Duck standing above a rock', 'amardo_osmani', 'eridon_cuni', 100),
('https://images.unsplash.com/photo-1551712345-dd631d6b58dc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDIwfHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60', 'Mother duck with her ducklings', 'amardo_osmani', 'amardo_osmani', 300),
('https://images.unsplash.com/photo-1574137909559-82597cfeef21?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1176&q=80', '2 Ducks', 'amardo_osmani', 'amardo_osmani', 200),
('https://images.unsplash.com/photo-1597840637868-417c13c7e962?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1142&q=80', 'Duck by a pond', 'amardo_osmani', 'amardo_osmani', 122),
('https://images.unsplash.com/photo-1603186748174-2baadb2d5245?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80', 'Duck looking behind', 'aldi123', 'aldi123', 95),
('https://images.unsplash.com/photo-1618590544501-46097e3fb96e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80', 'Friendly looking duck', 'aldi123', 'aldi123', 140);


