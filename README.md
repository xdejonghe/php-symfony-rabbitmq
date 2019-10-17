This project was did to validate some proposals to improve the usage of RabbitMQ with Symfony. 


**Findings**

* Infrastructure
  * DEV's RabbitMQ instance consumes too much resources even without a load
  * No dynamic sizing of the number of processes (management by supervisor)
  * All environments are on the same RabbitMq
  * RabbitMq Usage
  * Systematic creation of an exchange for a queue
  * Fanout exchange usage for a single queue

* Business constraints
  * Need to temporarily stop the consumption of a queue (eg no more sending mails)
  * Purge all messages with a certain type (ex: notifications)
  * Guarantee the treatment of a handler who could be disturbed by other handlers long to run

**Proposals**
* Mutualize the use of exchanges (by defining them explicitly)
* Use the notion of vhost or create dedicated instances by environment
* Do not use fanout except real need
* Stop using supervisor to delegate to Kubernetes the task of scoring processes
* Launch multiple consumers at the same time :
`php bin / console messenger: consume job-direct1-transport job-direct2-transport job-direct-keys-transport`


**Requirement**
* create an host named local in RabbitMq

**Content**
- scripts/  *some dumb useful scripts (for php/symfony dummies like me)*
  - docker-compose.yml: RabbitMq configuration
  - runRabbitMq.sh: start RabbitMq
  - getRoute.sh: get all Symfony REST routes
  - runHandler.sh: start the handler. You should get the transport name
  - runServer.sh: start the server
- config/
  - packages/messenger.yaml: contains the transports configuration