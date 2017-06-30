//package foo;
//
//import org.springframework.beans.factory.config.BeanDefinition;
//import org.springframework.beans.factory.support.BeanDefinitionRegistry;
//import org.springframework.beans.factory.support.DefaultBeanNameGenerator;
//import org.springframework.context.ApplicationEvent;
//import org.springframework.context.ApplicationListener;
//import org.springframework.context.annotation.AnnotationConfigApplicationContext;
//import org.springframework.context.annotation.Bean;
//import org.springframework.stereotype.Component;
//
//import java.util.logging.Logger;
//
//@Component
//public class Peeker {
//
//    public static void main(String[] args) {
//        AnnotationConfigApplicationContext appCtx = new AnnotationConfigApplicationContext();
//        appCtx.setBeanNameGenerator(new RealDefaultBeanNameGenerator());
//
//        appCtx.scan("specified");
//        appCtx.refresh();
//        appCtx.register(specified.Peeker.class);
//        appCtx.getBean("Andrew_specified.Peeker#0");
//        appCtx.close();
//
//    }
//}
//
//
//@Component
//class OurConfig {
//
//    @Bean
//    public Peeker2 peeker2() {
//        return new Peeker2();
//    }
//
//
//}
//
//class RealDefaultBeanNameGenerator extends DefaultBeanNameGenerator {
//
//    @Override
//    public String generateBeanName(BeanDefinition definition, BeanDefinitionRegistry registry) {
//        return "Andrew_"+ super.generateBeanName(definition, registry);
//    }
//}
//
//class Peeker2 implements ApplicationListener<ApplicationEvent> {
//    private static final Logger log = Logger.getLogger(Peeker.class.getName());
//
//    @Override
//    public void onApplicationEvent(ApplicationEvent event) {
//        log.severe("Received Event: " + event);
//    }
//}