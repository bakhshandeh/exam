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
);