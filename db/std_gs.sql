create table std_stdgs(
    id                  int auto_increment primary key,
    std_id              int references students,
    g_id                int references stdgroups
);