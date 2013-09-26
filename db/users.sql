create table students(
    id                  int auto_increment primary key,
    email               text,
    pass                text,
    city                text,
    area                text,
    country             text,
    address             text,
    mobile              text,
    name                text,
    roll_number         text,
    enrol_number        text,
    phone               text,
    alt_phone           text,
    parent_phone        text,
    status              int default 0,
    comments            text,
    date                date
);

create table stdgroups(
    id                  int auto_increment primary key,
    title               text
);
