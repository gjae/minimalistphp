create table IF NOT EXISTS users(
	created_at datetime default null,
	updated_at datetime default null,
	deleted_at datetime default null,
	id integer unsigned auto_increment primary key,
	email varchar(150) unique not null,
	password varchar(40) not null
);


delete from users;

INSERT INTO usuarios(email, password)
	VALUES('admin@admin.com', '21232f297a57a5a743894a0e4a801fc3');