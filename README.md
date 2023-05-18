# Тестовое задание Boxberry

1. Вы работаете над проектом умной больницы, где каждый из 1000 пациентов имеет специальный датчик, который раз в 10 минут передает сведения о пульсе и давлении подопечного.  
   Напишите SQL таблицы для хранения этих данных, учитывая то, что один из самых частых запросов к ней будет: выбор всех подопечных у которых после обеда были превышены нормы пульса и давления.

   [Решение](https://github.com/shurinm/Boxberry/blob/master/tasks/PatientsCheck/PatientsCheck.php)


2. У вас есть база размером свыше 100гб и более 8млн строк. Вам необходимо добавить 3 новых поля, переименовать одно поле, а также добавить два индекса. Опишите, как вы это будете делать?

         1) Создать новую таблицу с нужными полями и индексами;
         2) Делаем дамп существующей таблицы, затем загружаем его в новую таблицу;
         3) Блокируем старую (исходную) таблицу на запись, измененяем названия таблиц на необходимые
         4) Желательно проверить старую таблицу на предмет новых записей, которых нет в новой копии (могли появиться во время снятия дампа);
         5) Снимаем блокировку исходной таблицы и используем её уже изменённую.

   сейчас много готов библиотек и инструментов, функционал которых, в целом, подходит под решение поставленной задачи:  
   [GitHub Online Schema Change](https://github.com/github/gh-ost),  
   [pt-online-schema-change](https://www.percona.com/doc/percona-toolkit/2.2/pt-online-schema-change.html),  
   [OnlineSchemaChange](https://github.com/facebookincubator/OnlineSchemaChange)


3. Напишите PHP скрипт в который через GET передаются две даты, а скрипт должен рассчитать сколько вторников было между ними.

   [Решение](https://github.com/shurinm/Boxberry/blob/main/tasks/CountTuesdays/%D0%A1ountTuesdays.php)


4. Есть таблица, которая хранит сведения о товарах вида:
   ``
   CREATE TABLE `products ` (
     `id` int(11) NOT NULL,
     `name` tinytext,
     `price` float(9,2) DEFAULT '0.00',
     `color` tinytext,
     UNIQUE KEY `id` (`id`)
   ) ENGINE=innoDB;
   ``

   | id  | name  | price | color |
   | --- | ----- | ----- | ----- |
   | 1   | Товар | 10    | green |
   | 2   | Товар | 11    | red   |
   | 3   | Товар | 35    | red   |

   и т.д. товаров более 1млн. Различных цветов более 100.

   Перед вами стоит задача, обновить цену в зависимости от цвета товара. Например, товарам с color=red цену уменьшить на 5%, товарам с color=green, увеличить цену на 10% и т.д.
   Напишите PHP + SQL скрипт как это сделать максимально эффективно с точки зрения производительности.

   Для заполнения данными можно воспользоваться [готовой библиотекой](https://github.com/fzaninotto/Faker)  
   [Массив названий цветов](https://gist.github.com/slikts/cfa5bb0ad340b6e01dd711f20a419aec)  
   [Решение](https://github.com/shurinm/Boxberry/blob/main/tasks/ChangePrice/ChangePrice.php)
