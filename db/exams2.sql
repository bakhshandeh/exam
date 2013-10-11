create table exam_stdgroups(
    id                  int auto_increment primary key,
    eid                int references exams,
    gid                 int references stdgroups
);

create table exam_qs(
    id          int auto_increment primary key,
    qid         int references questions,
    eid         int references exams
);
