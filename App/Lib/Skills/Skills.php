<?php

namespace App\Lib\Skills;

use \App\Lib\Utils\Debugger;

abstract class Skills
{
    use Traits\ParseItemsTrait;

    public static $lists = [
        'encouragement' => '1',
        'directions' => '2',
        'use-rewards' => '3',
        'clear-rules' => '4',
        'consequences' => '5',
        'monitor' => '6',
        'school-success' => '7',
        'listening' => '8',
        'meetings' => '9',
    ];

    protected static $titles = [

            "Trying to change your parenting approach can be overwhelming. Start by figuring out what you are doing well and then identify areas that you can improve. If you are happy with your current parenting strategies, then take a look at the skills presented in this program to see if they are similar to what you are already doing.",

            "Children who receive encouragement are more likely to believe they can do better if they try hard.",

            "Encouragement is key to building confidence and a strong sense of self. By providing consistent attention and encouragement you help your child feel good about themselves and gives them confidence to try new activities, develop new friendships, explore their creativity, and tackle difficult tasks. ",

            "Remember that giving effective directions is a first step in getting your child to comply with your requests. Don't get discouraged if your requests don't work right away. It takes time for you to master a new skill ",

            "Be sure to give yourself credit for the hard work you are doing to improve your relationship with your child.",

            "It may take weeks of you trying out new ways of giving directions before you see a positive change in your child's response. Stick with it! (Hint: Using other skills from this program, like encouragement and praise, when you give directions may help to speed up the results!) ",

            "Almost all parents tend to focus on their child's negative behavior, and they try to figure out how to make their children change.  However, the focus is on you in this skill session. The overall goal is to help you notice more of your child's positive behaviors – and to increase these behaviors by encouraging, praising, and rewarding them. Being positive helps make your child feel happier and more successful. Start with small behaviors so that your child can gain confidence. Then they can gradually build off those early successes to improve even more.",

            "Avoid making rewards too big. It's really helpful for your child to actually experience the reward in order for them to feel motivated. And be careful not to make the task or goal too difficult, especially at the start. If your child never achieves the goal, or if it happens only rarely. then the task is too big.",

            "You may be surprised to learn that many middle-schoolers report that they enjoy spending special time with their parents – and it is a valued reward. Particularly spending time to choose dinner and then making it together.",

            "Consistency is key! Try using your new parenting skills as consistently as possible.",

            "You may find it helpful to think of your children's technology devices as a privilege that they can earn…or lose. As the parent, you make the rules when it comes to how and when your child gets to use their smartphone or play computer games.",

            "Everyone benefits when there is agreement about the household rules. When your child understands what they are expected to do, then they are less likely to argue and display other problem behaviors. When there is less confusion and conflict at home, then the entire family is more likely to enjoy spending time with each other. ",

            "Your child's moods and behaviors can be especially challenging during transition times, like the move from elementary into middle and high school. When your child matures physically their mood can also be affected, that's why adolescents are often described as “moody” and “irritable.” ",

            "Did you know that teens are more likely to follow household rules if they know parents are going to stick with them? Try to pick rules that are important to your family and that you can enforce.",

            "Children are more likely to follow new rules when they receive a small reward for their good behavior. For example, if your child is expected to clear the table after dinner, then you could praise them for following the rule. If your child remembers to put their backpack on the hook and put their shoes away each day after school, then they could earn an extra 10 minutes of screen time.",

            "If you're parenting with a partner, it's important that you agree on your practices so that you give your child a consistent message. When parents disagree it creates confusion for children and it provides an opportunity for children not to follow either parent's guidance.",

            "In blended families conflict is decreased if the biological parent is in charge of “discipline” and the non-biological parent encourages and supports the child to follow the expectations of the biological parent.",

            "Parents who set limits provide boundaries that show their child that they care. This teaches children self-control, responsibility, and that following rules is important to success in life. ",

            "It's easy to get distracted by your child's negative behaviors. Your emotional reaction can get you off track. Don't get caught up in trying to argue your position. Stay positive or neutral and focus on your end goal.",

            "Parents are most effective at setting limits when they follow up  ith rewards or consequences right away. ",

            "Don't expect to see positive changes in your child's behavior right away! In fact, it wouldn't be surprising if your child actually misbehave more when you start trying out new ways for your family to interact.",

            "You don't have to make a quick decision about which consequence to choose. It is okay to tell your child you will need to think about a consequence. This will give you some time to calm down and figure out a fair and effective consequence.",

            "Your child may get angry or misbehave when you enforce a consequence. They are testing you and your limits. Don't react. Stick with your rules.",

            "Giving consequence to help shape child behavior is a tool that is most effective when it is used sparingly. If your child is getting consequences every day, then it may be time to evaluate whether your household rules are reasonable. It may also help to think of some new consequence that are more effective.",

            "Children rely on predictability. Remember to consistently use consequences when your child misbehaves seriously or breaks a rule.. What consequence you use is less important than establishing the predictability that something will happen. ",

            "All children will misbehave. But your use of parenting skills like encouragement, praise, and rewards, combined with appropriate consequences, can help ensure that these incidents don't become a habit or pattern.",

            "5-minute work chores are quite effective for minor behavior problems; try: <ul><li>Wipe the baseboards or window sills in one room</li><li>Put away the dishes</li><li>Vacuum a room</li></ul>",

            "You should always know in advance: <ul><li>Where your child is</li><li>Who they're with</li><li>When they'll be home</li><li>Which responsible adult or parent will be there</li><li>How to reach them</li></ul>",

            "Many parents become visibly upset after they discover that their child spent time with kids who smoke. It's important for you to stay calm so your child knows it is safe for them to share their experiences with you. If you react too quickly, or show too much emotion, then your child might shut down. Then you won't know what is happening when you're not around.",

            "Children whose parents monitor them are more likely to: <ul><li>Avoid drugs, alcohol and cigarettes</li><li>Have better grades, and miss fewer days of school</li><li>Avoid lying, stealing, and committing other crimes</li><li>Avoid early and risky sex</li></ul>",

            "Childhood is a time of big growth and change. It can make your child feel unsure of who they are and overwhelmed by a need to please and impress their friends. This susceptibility to peer pressure is one reason why monitoring is so important.",

            "Did you know that cigarette smoking is most likely to be established during adolescence? This is another reason why monitoring is so important right now.",

            "Tell your child how important school is. ",

            "Show your child that the skills they learn in school today, will help them when they are adults, too...For example: <ul><li>If your child has reading homework, be sure to try to read in front of them, often</li><li>If your child is doing math homework while you are cooking, then talk through a calculation to double or half your recipe</li></ul>",

            "Say positive things about homework. Ask about it, be involved. The attention you show and attitudes you express can affect your child's attitude about homework.",

            "When your child asks for help, provide guidance, interest, and encouragement – not answers.",

            "Even in Middle School, children can focus on homework better if they eat an after-school snack.",

            "If school has let you know that your child doesn't turn in homework, or that it  is late or incomplete; then you might consider meeting with your child's teachers to share your plans for getting them back on track, and get their help. ",

            "To help your child get homework assignments turned in on time, try to list each assignment and when it's due in a planner or calendar.",

            "Questions to ask about homework: <ul><li>What's your assignment today?</li><li>When is it due?</li><li>Is it a longterm assignment (e.g., a term paper or science project)?<ul><li>For a major project, would it help to write out the steps or make a schedule?</li></ul></li><li>Have you started it? Finished it?</li><li>Is the assignment clear? (if not, suggest calling the school's homework hotline or a classmate)</li><li>Do you need special resources (e.g., access to a computer)?</li><li>Do you need special supplies (e.g., graph paper or posterboard)?</li></ul>",

            "Pay attention to the times of day when your child is more open to talking and then figure out ways you can help  make that happen. For example, your child might be more talkative at bed time, when in the car, or while you are making dinner together. It probably won'd surpris you to learn, conversations that don't involve direct eye contact can sometimes lead to more open communication.",

            "Giving your child space to share their thoughts and concerns with you is really improtant. Be patient  when they are talking to you, and try to keep your initial worries and judgements to yourself. Though it may feel urgent in the moment, most things don't require immediate action.You can always follow up after your child has finished telling you their whole story.",

            "When asking your child questions, try using a pleasant tone of voice. And show your interest or concern, not your disapproval.",

            "When you listen with patience and uderstanding, you strengthen the trust and respect between you and your child.",

            "Many parents become visibly upset after they discover that their child spent time with kids who smoke. It's important for you to stay calm, though. That way your child knows it is safe for them to share their experiences with you. If you react too quickly, or show too much emotion, then your child might shut down. Then you risk not knowing what is happening when you're not around.",

            "Good communication and problem solving skills are the foundation of effective parenting. As children grow they develop their own problem solving skills that help them face new challenges and experiences outside of the home.",

            "Remember to ask for your child's opinions when brainstorming ways to solve a family problem. Even more important: try to be open to your child's ideas and don't be judgemental while brainstorming. By including your child in the problem solving process, you are helping them to focus on solutions, buy into the plan, and learn how to be more responsible for managing their behavior.",

            "Family meetings are one of the the harder parenting skills to learn. But  they are worth it.  They allow you and your child to discuss problems and negotiate solutions—together!",

            "Negotiating with your child can be challenging. But getting them involved in thinking through the plans that affect the family helps them: <ul><li>Learn how to communicate their opinions</li><li>Come up with practical solutions</li><li>Feel like a part of the solution </li><li>Be more willing to cooperate. </li></ul>",

            "The time and adjustments you put toward adapting to the challenges your child presents as they grow, is what builds your healthy, rewarding relationship. ",

            "Having a time to check-in about an agreed upon solution - and knowing that if it's not working, adjustments will be made - seems to help people be more flexible when trying new things!"
        ];

        public static function getListId($listName)
        {
            return self::$lists[$listName];
        }
}