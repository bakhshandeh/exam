create table exam_attempts(
    id                  int auto_increment primary key,
    eid                 int references exams,
    std_id              int references students,
    attempt_num         int default 1,
    start_date          timestamp,
    end_date            timestamp,
    is_submitted        int default 0,
    score               float,
    is_passed           int
);

create table attempt_qs(
    id          int auto_increment primary key,
    qid         int references questions,
    attempt_id  int references exam_attempts,
    answer      text,
    is_true     int
);


