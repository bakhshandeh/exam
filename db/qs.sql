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
