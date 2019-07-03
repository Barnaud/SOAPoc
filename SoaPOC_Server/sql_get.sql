select q.question, ifnull(a.count_a,0), ifnull(b.count_b, 0), ifnull(c.count_c, 0), ifnull(d.count_d,0), ifnull(e.count_e,0), ifnull(f.count_f,0) from 
(select question FROM reponses) q
left join (select question, count(*) as count_a from reponses where reponses like '%a%' group by question) a on q.question = a.question
LEFT JOIN (select question, count(*) as count_b from reponses where reponses like '%b%' group by question) b on q.question = b.question
LEFT JOIN (select question, count(*) as count_c from reponses where reponses like '%c%' group by question) c on q.question = c.question
LEFT JOIN (select question, count(*) as count_d from reponses where reponses like '%d%' group by question) d on q.question = d.question
LEFT JOIN (select question, count(*) as count_e from reponses where reponses like '%e%' group by question) e on q.question = e.question
LEFT JOIN (select question, count(*) as count_f from reponses where reponses like '%f%' group by question) f on q.question = f.question
group by a.question
order by q.question asc;



select q.question, ifnull(a.count_a,0), ifnull(b.count_b, 0), ifnull(c.count_c, 0), ifnull(d.count_d,0), ifnull(e.count_e,0), ifnull(f.count_f,0) from 
(select 1 as question) q
LEFT JOIN (select question, count(*) as count_a from reponses where reponses like '%a%' HAVING question=1) a on q.question = a.question
LEFT JOIN (select question, count(*) as count_b from reponses where reponses like '%b%' HAVING question=1) b on q.question = b.question
LEFT JOIN (select question, count(*) as count_c from reponses where reponses like '%c%' HAVING question=1) c on q.question = c.question
LEFT JOIN (select question, count(*) as count_d from reponses where reponses like '%d%' HAVING question=1) d on q.question = d.question
LEFT JOIN (select question, count(*) as count_e from reponses where reponses like '%e%' HAVING question=1) e on q.question = e.question
LEFT JOIN (select question, count(*) as count_f from reponses where reponses like '%f%' HAVING question=1) f on q.question = f.question
group by a.question
order by q.question asc
--Remplacer 1 par numero de question