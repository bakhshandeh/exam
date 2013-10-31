create table subjects(
        id      int auto_increment primary key,
        title   text
);
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


#--- 0:subjective 1: Objective 2: Multiple choice 3: true false ---
create table questions(
    id                  int auto_increment primary key,
    type                int, 
    subject             int references subjects,
    hint                text,
    diff_level          text,
    mark                float,
    neg_mark            float,
    answer              int,
    body                text,
    flags               text
);

create table qanswers(
    id          int auto_increment primary key,
    qid         int references questions,
    body        text,
    is_true     int default 0
);
create table exams(
    id                  int auto_increment primary key,
    name                text,
    duration            time,
    start_date          timestamp,
    end_date            timestamp,
    declare_results     integer default 0,
    details             integer default 0,
    insts               text,
    neg_mark            float,
    pass_p              float
);create table exam_stdgroups(
    id                  int auto_increment primary key,
    eid                int references exams,
    gid                 int references stdgroups
);

create table exam_qs(
    id          int auto_increment primary key,
    qid         int references questions,
    eid         int references exams
);
