create table stdexam_qs(
    id          int auto_increment primary key,
    qid         int references questions,
    eid         int references exams,
    std_id      int references students,
    answer      text
);
