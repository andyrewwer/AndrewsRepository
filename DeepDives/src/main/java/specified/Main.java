package specified;

import org.springframework.context.ApplicationEvent;
import org.springframework.context.ApplicationListener;
import org.springframework.context.annotation.AnnotationConfigApplicationContext;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.stereotype.Component;

import java.util.logging.Logger;

public class Main {

    public static void main(String[] args) {
        AnnotationConfigApplicationContext appCtx = new AnnotationConfigApplicationContext();
        appCtx.register(HelloWorldConfig.class);
        appCtx.refresh();
        appCtx.close();

    }
}


@Component
class HelloWorldConfig {
    private static String name = "Fibidabibop";

//    @Configuration
    public class OuterConfig {
        @Bean
        public Peeker peeker(){
            return new Peeker();
        }
    }

    @Configuration
    public class InnerConfig {
        public class EvenMoreInnerConfig {
            @Bean
            public Peeker2 peeker2(){
                name = "modified";
                System.out.println(name);
                return new Peeker2();
            }
        }
    }

//    @Bean
//    public String someBean() {
//        return "foo";
//    }
}

class Peeker implements ApplicationListener<ApplicationEvent> {
    private static final Logger log = Logger.getLogger(Peeker.class.getName());

    @Override
    public void onApplicationEvent(ApplicationEvent event) {
        log.severe("Received Event ACTIVE: " + event);
    }
}

class Peeker2 implements ApplicationListener<ApplicationEvent> {
    private static final Logger log = Logger.getLogger(Peeker2.class.getName());

    @Override
    public void onApplicationEvent(ApplicationEvent event) {
        log.severe("Received Event STATIC: " + event);
    }
}

