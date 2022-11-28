create table articles
(
    Id              bigint auto_increment
        primary key,
    Titre           varchar(50)  null,
    Description     text         null,
    DatePublication date         null,
    Auteur          varchar(50)  null,
    ImageRepository varchar(50)  null,
    ImageFileName   varchar(255) null
);

create table users
(
    Id       bigint auto_increment
        primary key,
    mail     varchar(50)                  null,
    password varchar(50)                  null,
    roles    longtext collate utf8mb4_bin null,
    constraint users_pk
        unique (mail),
    constraint roles
        check (json_valid(`roles`))
);