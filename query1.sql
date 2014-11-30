with recursive podriadeny as (
    select e2.empno as zamestnanec, e1.empno as podriadeny
    from emp e1, emp e2
    where e1.mgr = e2.empno
        union
    select p.zamestnanec, e.empno as podriadeny
    from emp e, podriadeny p
    where e.mgr = p.podriadeny
)
select e1.ename as meno, count(p.podriadeny) as pocet_podriadenych, avg(e2.sal) as priemerny_plat
from emp e1, emp e2, podriadeny p
where p.zamestnanec = e1.empno and p.podriadeny = e2.empno
group by e1.ename;
