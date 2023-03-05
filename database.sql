create table users ( 
    user_id int NOT NULL AUTO_INCREMENT, 
    google_id varchar(100) NOT NULL, 
    user_name varchar(100) NOT NULL, 
    user_email varchar(50) NOT NULL, 
    user_profile_picture varchar(100), 
    PRIMARY KEY (user_id) 
);

create table assets ( 
    asset_id int NOT NULL AUTO_INCREMENT, 
    asset_name varchar(50) NOT NULL, 
    description varchar(200), 
    total int NOT NULL, 
    created_date DATETIME NOT NULL, 
    created_user varchar(50) NOT NULL, 
    modifies_date DATETIME, 
    modifies_user varchar(50) 
);

create table requests ( 
    request_id int NOT NULL AUTO_INCREMENT, 
    primary key (request_id), 
    user_id int NOT NULL,
    asset_id int NOT NULL, 
    owner_id int NOT NULL, 
    start_date DATETIME NOT NULL, 
    end_date DATETIME NOT NULL, 
    description varchar(200), 
    created_date DATETIME NOT NULL, 
    is_approved boolean NOT NULL, 
    approved_date DATETIME, 
    approved_user varchar(50), 
    status varchar(50) NOT NULL, 
    modifies_date DATETIME, 
    modifies_user DATETIME 
);