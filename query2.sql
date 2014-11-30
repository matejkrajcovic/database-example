select d.deptno as oddelenie, s.grade as stupen, count(e.empno) as pocet_zamestnancov
from dept d, salgrade s, emp e
where d.deptno = e.deptno and e.sal >= s.losal and e.sal <= s.hisal
group by d.deptno, s.grade;
