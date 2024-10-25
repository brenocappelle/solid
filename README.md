Codigo original->  

1.	SRP (Single Responsibility Principle):
o	A classe Pizza é responsável por calcular o preço e também exibir a pizza em HTML. A lógica de exibição deveria estar separada.
o	A classe Order possui a lógica de adicionar pizzas, calcular o total, processar o pagamento e exibir o pedido. Essas funções são diversas e poderiam ser divididas.
2.	OCP (Open/Closed Principle):
o	Pizza e Order não estão preparadas para extensões, pois a lógica de cálculo de preços e de pagamento é rígida, dificultando a adição de novos tipos de pizzas, formas de pagamento, etc.
3.	LSP (Liskov Substitution Principle):
o	Como não há herança explícita aqui, não há uma violação direta. Contudo, o código poderia ser estruturado para permitir que diferentes tipos de pizza, como PizzaEspecial, sejam tratadas de forma intercambiável.
4.	ISP (Interface Segregation Principle):
o	Nenhuma interface foi implementada. Uma interface para Displayable ou Calculable poderia ser criada para dividir responsabilidades e segregar métodos.
5.	DIP (Dependency Inversion Principle):
o	Order está diretamente instanciando Pizza e possui uma dependência rígida de como calcular o preço e processar o pagamento. A implementação de abstrações, como interfaces de pagamento, pode ajudar a resolver esse problema.


codigo refatorado->

1- SRP (Single Responsibility Principle):
Pizza: agora se concentra apenas nos dados da pizza e no cálculo do preço.
PizzaDisplay: se encarrega da exibição da pizza.
Order: trata apenas do gerenciamento de pizzas no pedido e do cálculo do total.
OrderDisplay: cuida da exibição do pedido.

2- OCP (Open/Closed Principle):
Novas implementações de exibição ou métodos de pagamento podem ser adicionadas sem modificar as classes existentes. Por exemplo, é possível criar outras classes de pagamento sem alterar Order.

3- LSP (Liskov Substitution Principle):
Caso sejam necessárias novas variações de pizza ou pedidos com tipos de pagamento diferentes, elas podem substituir as classes originais sem quebrar o funcionamento.

4- ISP (Interface Segregation Principle):
Foram criadas interfaces separadas para PriceCalculable e Displayable, que dividem as responsabilidades de cálculo e exibição, respectivamente.

5- DIP (Dependency Inversion Principle):
Order depende de uma abstração para o método de pagamento (PaymentMethod), o que permite a injeção de diferentes tipos de pagamento.
