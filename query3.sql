with stupen_plat as (
    select s.grade as stupen, e.sal as plat
    from emp e, salgrade s
    where e.sal >= s.losal and e.sal <= s.hisal
), stupen_max_plat as (
    select sp.stupen, max(sp.plat) as max
    from stupen_plat sp
    group by sp.stupen
)
select s.grade as stupen, smp.max as maximalny_plat, count(e.empno) as pocet_zamestnancov, sum(smp.max - e.sal) as celkove_naklady, avg(smp.max - e.sal) as priemerne_zvysenie
from salgrade s, emp e, stupen_plat sp, stupen_max_plat smp
where sp.stupen = s.grade and sp.plat = e.sal and smp.stupen = s.grade and e.sal < smp.max
group by s.grade, smp.max
order by s.grade;
