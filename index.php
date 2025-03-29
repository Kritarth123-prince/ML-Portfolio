<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

session_start();

if (isset($_SESSION['form_success_time']) && (time() - $_SESSION['form_success_time']) > 10) {
    unset($_SESSION['form_success']);
    unset($_SESSION['form_success_time']);
}

$messageSent = isset($_SESSION['form_success']) ? $_SESSION['form_success'] : false;
$formDisabled = $messageSent && (time() - $_SESSION['form_success_time']) <= 10;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_form'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $country_code = htmlspecialchars(trim($_POST['country_code']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kritarthranjan2@gmail.com';  // Sender
            $mail->Password = 'oygb wdyi gxdr sxpb';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email Content
            $mail->setFrom('kritarthranjan2@gmail.com', 'Portfolio Contact Form');
            $mail->addAddress('kritarthranjan5053@gmail.com');   // Reciver
            $mail->addReplyTo($email, $name);
            
            $mail->isHTML(true);
            $mail->Subject = "New Contact from Portfolio: $name";
            $mail->Body = "
                <h2>New Contact Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $country_code $phone</p>
                <p><strong>Message:</strong></p>
                <p>$message</p>
            ";
            $mail->AltBody = "Name: $name\nEmail: $email\nPhone: $country_code $phone\nMessage:\n$message";
            
            if ($mail->send()) {
                $_SESSION['form_success'] = true;
                $_SESSION['form_success_time'] = time();
                header("Location: ".$_SERVER['PHP_SELF']."#contact");
                exit();
            } else {
                error_log("Mailer Error: " . $mail->ErrorInfo);
                echo "<script>console.error('Mailer Error: " . addslashes($mail->ErrorInfo) . "');</script>";
            }
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            echo "<script>console.error('Error: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
}


$dob = new DateTime('2004-10-29');
$today = new DateTime();
$age = $today->diff($dob)->y;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kritarth Ranjan | Machine Learning Engineer & Data Scientist</title>
    <meta name="description" content="Professional portfolio of Kritarth Ranjan showcasing skills, projects, and experience in AI/ML.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script>
        // Automatically hide success message and show form after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.querySelector('.form-success');
            const contactForm = document.querySelector('.contact-form form');
            
            if (successMessage && successMessage.style.display === 'block') {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                    if (contactForm) contactForm.style.display = 'block';
                }, 10000);
            }
        });
    </script>
</head>
<body>
    <div class="container">
        <!-- Hero Section -->
        <header class="hero">
            <div class="hero-content">
                <h1 class="hero-title"><span id="typing-text"></span><span class="typed-cursor">|</span></h1>
                <h2 class="hero-subtitle">Lead MLE & Data Scientist</h2>
                <p class="hero-description">
                    <?= $age ?> year old AI/ML professional with <?= $today->diff(new DateTime('2021-08-01'))->y ?>+ years of experience in building and deploying machine learning models.
                    Passionate about solving complex problems with data-driven solutions.
                </p>
                <div class="hero-buttons">
                    <a href="#contact" class="btn btn-primary">Contact Me</a>
                    <a href="assets/resume.pdf" download class="btn btn-secondary">Download Resume</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="assets/profile1.png" alt="Kritarth Ranjan">
                <div class="image-caption">Born: Oct 29, 2004</div>
            </div>
        </header>

        <!-- About Section -->
        <section class="section about" id="about">
            <h2 class="section-title">About Me</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>I'm a passionate Machine Learning Engineer and Data Scientist with expertise in developing end-to-end AI solutions. My journey in AI/ML began during my college years, and I've since worked on diverse projects ranging from computer vision to predictive analytics.</p>
                    
                    <p>Currently leading the ML team at BrainSightAI, I specialize in building scalable machine learning systems and deploying models in production environments. I'm particularly interested in the intersection of neuroscience and artificial intelligence.</p>
                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section class="skills section" id="skills">
            <h2 class="section-title">Skills</h2>
            <span class="section-subtitle">My technical & other skills</span>

            <div class="skills-container container grid">
                
                <div>
                    <div class="skills-content skills-open">
                        <div class="skills-header">
                            <i class="uil uil-brain skills-icon"></i>

                            <div>
                                <h1 class="skills-title">Data Science & AI</h1>
                                <span class="skills-subtitle">4+ Years XP</span>
                            </div>

                            <i class="uil uil-angle-down skills-arrow"></i>
                        </div>

                        <div class="skills-list grid">  
                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Computer Vision</h3>
                                    <span class="skills-number">95%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-cv"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Generative AI</h3>
                                    <span class="skills-number">95%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-nlp"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Natural Language Processing</h3>
                                    <span class="skills-number">95%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-nlp"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Signal Processing</h3>
                                    <span class="skills-number">90%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-ap"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Probability & Statistics</h3>
                                    <span class="skills-number">90%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-ps"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Data Analytics & Visualization</h3>
                                    <span class="skills-number">85%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-dav"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Frameworks & Libraries</h3>
                                    <span class="skills-number">90%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-frameworks"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="skills-content skills-close">
                        <div class="skills-header">
                            <i class="uil uil-brackets-curly skills-icon"></i>

                            <div>
                                <h1 class="skills-title">Programming</h1>
                                <span class="skills-subtitle">3+ Years XP</span>
                            </div>
                            
                            <i class="uil uil-angle-down skills-arrow"></i>
                        </div>

                        <div class="skills-list grid">
                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Python</h3>
                                    <span class="skills-number">95%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-python"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">SQL</h3>
                                    <span class="skills-number">95%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-sql"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">C++/C</h3>
                                    <span class="skills-number">90%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-cpp"></span>
                                </div>
                            </div>
                            
                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Java</h3>
                                    <span class="skills-number">90%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-java"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="skills-content skills-close">
                        <div class="skills-header">
                            <i class="uil uil-cloud-computing skills-icon"></i>

                            <div>
                                <h1 class="skills-title">Computing</h1>
                                <span class="skills-subtitle">1+ Year XP</span>
                            </div>
                            
                            <i class="uil uil-angle-down skills-arrow"></i>
                        </div>

                        <div class="skills-list grid">
                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">GPU & Distributed Computing</h3>
                                    <span class="skills-number">90%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-gpu"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Amazon Web Services</h3>
                                    <span class="skills-number">85%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-aws"></span>
                                </div>
                            </div>
                            
                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Google Cloud Platform</h3>
                                    <span class="skills-number">85%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-gcp"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Microsoft Azure</h3>
                                    <span class="skills-number">85%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-aws"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="skills-content skills-close">
                        <div class="skills-header">
                            <i class="uil uil-swatchbook skills-icon"></i>

                            <div>
                                <h1 class="skills-title">Front End</h1>
                                <span class="skills-subtitle">2+ Years XP</span>
                            </div>

                            <i class="uil uil-angle-down skills-arrow"></i>
                        </div>

                        <div class="skills-list grid">
                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">HTML</h3>
                                    <span class="skills-number">90%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-html"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">CSS</h3>
                                    <span class="skills-number">85%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-css"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">JavaScript</h3>
                                    <span class="skills-number">75%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-js"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">React JS</h3>
                                    <span class="skills-number">85%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-react"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">React Native</h3>
                                    <span class="skills-number">85%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-react"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="skills-content skills-close">
                        <div class="skills-header">
                            <i class="uil uil-server-network skills-icon"></i>

                            <div>
                                <h1 class="skills-title">BackEnd</h1>
                                <span class="skills-subtitle">2+ Years XP</span>
                            </div>

                            <i class="uil uil-angle-down skills-arrow"></i>
                        </div>

                        <div class="skills-list grid">
                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Python - Flask, Fast API</h3>
                                    <span class="skills-number">95%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-pythons"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Firebase</h3>
                                    <span class="skills-number">75%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-firebase"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Java - Spring Framework</h3>
                                    <span class="skills-number">75%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-javas"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Node JS, Express JS</h3>
                                    <span class="skills-number">70%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-node"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="skills-content skills-close">
                        <div class="skills-header">
                            <i class="uil uil-analysis skills-icon"></i>

                            <div>
                                <h1 class="skills-title">Misc</h1>
                                <span class="skills-subtitle">2+ Years XP</span>
                            </div>

                            <i class="uil uil-angle-down skills-arrow"></i>
                        </div>

                        <div class="skills-list grid">
                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Git</h3>
                                    <span class="skills-number">90%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-git"></span>
                                </div>
                            </div>

                            <div class="skills-data">
                                <div class="skills-titles">
                                    <h3 class="skills-name">Linux</h3>
                                    <span class="skills-number">90%</span>
                                </div>
                                <div class="skills-bar">
                                    <span class="skills-percentage skills-linux"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Research Papers Section -->
        <section class="section research" id="research">
            <h2 class="section-title">Research Publications</h2>
            <span class="section-subtitle">My academic contributions</span>

            <div class="research-container">
                <div class="research-card">
                    <div class="research-header">
                        <h3 class="research-title">KrishiVaani: A Conversational Hindi Speech Corpus through Automatic ASR
                        Post-Correction and Accelerated Refinement</h3>
                        <span class="research-journal">Journal of Machine Learning Research</span>
                        <span class="research-date">2025</span>
                    </div>
                    <p class="research-authors">Kritarth Ranjan, Co-author 1, Co-author 2</p>
                    <p class="research-abstract">Building robust, real-world Automatic Speech Recognition (ASR) datasets for Hindi remains challenging due to linguistic complexity, accent variations, and domain-specific vocabulary, particularly in agricultural contexts. This paper presents KrishiVaani, a conversational Hindi speech corpus that addresses the above-mentioned issues.</p>
                    <div class="research-links">
                        <a href="assets/Interspeech25__KrishiVaani__Building_a_Robust_Conversational_Hindi_ASR_System_via_open_source_tooling_for_rapid_data_validation_and_verification-5.pdf" class="research-link"><i class="fas fa-file-pdf"></i> PDF</a>
                        <a href="google.com" class="research-link"><i class="fas fa-external-link-alt"></i> DOI</a>
                        <a href="https://github.com/Kritarth123-prince/portfolio" class="research-link" target="_blank"><i class="fab fa-github"target="_blank"></i> Code</a>
                    </div>
                </div>

                <div class="research-card">
                    <div class="research-header">
                        <h3 class="research-title">Paper Title 2</h3>
                        <span class="research-journal">Neural Information Processing Systems (NeurIPS)</span>
                        <span class="research-date">2022</span>
                    </div>
                    <p class="research-authors">Co-author 1, Kritarth Ranjan, Co-author 2</p>
                    <p class="research-abstract">Brief abstract or description of the research paper. Highlight the key findings and your contribution to the work.</p>
                    <div class="research-links">
                        <a href="#" class="research-link"><i class="fas fa-file-pdf"></i> PDF</a>
                        <a href="#" class="research-link"><i class="fas fa-external-link-alt"></i> DOI</a>
                        <a href="#" class="research-link"><i class="fab fa-github"></i> Code</a>
                    </div>
                </div>

                <div class="research-card">
                    <div class="research-header">
                        <h3 class="research-title">Paper Title 3</h3>
                        <span class="research-journal">IEEE Transactions on Pattern Analysis and Machine Intelligence</span>
                        <span class="research-date">2021</span>
                    </div>
                    <p class="research-authors">Co-author 1, Co-author 2, Kritarth Ranjan</p>
                    <p class="research-abstract">Brief abstract or description of the research paper. Highlight the key findings and your contribution to the work.</p>
                    <div class="research-links">
                        <a href="#" class="research-link"><i class="fas fa-file-pdf"></i> PDF</a>
                        <a href="#" class="research-link"><i class="fas fa-external-link-alt"></i> DOI</a>
                        <a href="#" class="research-link"><i class="fab fa-github"></i> Code</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Experience & Education Section -->
        <section class="qualification section" id="experience">
            <h2 class="section-title">Experience</h2>
            <span class="section-subtitle">My journey in the academic & professional front</span>

            <div class="qualification-container">
                <div class="qualification-tabs">
                    <div class="qualification-button button-flex" data-target="#education">
                        <i class="uil uil-graduation-cap qualification-icon"></i>
                        Academic
                    </div>

                    <div class="qualification-button button-flex qualification-active" data-target="#work">
                        <i class="uil uil-briefcase-alt qualification-icon"></i>
                        Professional
                    </div>
                </div>

                <div class="qualification-sections">
                    <div class="qualification-content" data-content id="education">
                        <div class="qualification-data">
                            <div>
                                <h3 class="qualification-title">B.Tech - Information Technology</h3>
                                <span class="qualification-subtitle">Anna University, India</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    2017 - 2021
                                </div>
                            </div>

                            <div>
                                <span class="qualification-rounder"></span>
                                <span class="qualification-line"></span>
                            </div>
                        </div>
                        
                        <div class="qualification-data">                                 
                            <div></div>

                            <div>
                                <span class="qualification-rounder"></span>
                                <span class="qualification-line"></span>
                            </div>
                    
                            <div>
                                <h3 class="qualification-title">Class XII</h3>
                                <span class="qualification-subtitle">Maths, Physics, Chemistry, Computer Science | SDAV Higher Secondary School, India</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    2017
                                </div>
                            </div>
                        </div>

                        <div class="qualification-data">
                            <div>
                                <h3 class="qualification-title">Class X</h3>
                                <span class="qualification-subtitle">Central Board of Secondary Education | DAV School, India</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    2015
                                </div>
                            </div>

                            <div>
                                <span class="qualification-rounder"></span>
                            </div>
                        </div>
                    </div>

                    <div class="qualification-content qualification-active" data-content id="work">
                        <div class="qualification-data">
                            <div>
                                <h3 class="qualification-title">Lead MLE & Data Scientist</h3>
                                <span class="qualification-subtitle">BrainSightAI</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    Jul 2023 - Present
                                </div>
                            </div>

                            <div>
                                <span class="qualification-rounder"></span>
                                <span class="qualification-line"></span>
                            </div>
                        </div>
                        
                        <div class="qualification-data">
                            <div></div>

                            <div class="qualification-time">
                                <span class="qualification-rounder"></span>
                                <span class="qualification-line"></span>
                            </div>

                            <div>
                                <h3 class="qualification-title">Senior MLE & Data Scientist</h3>
                                <span class="qualification-subtitle">BrainSightAI</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    May 2022 - Jul 2023
                                </div>
                            </div>
                        </div>

                        <div class="qualification-data">
                            <div>
                                <h3 class="qualification-title">Machine Learning Engineer</h3>
                                <span class="qualification-subtitle">BrainSightAI</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    Aug 2021 - May 2022
                                </div>
                            </div>

                            <div>
                                <span class="qualification-rounder"></span>
                                <span class="qualification-line"></span>
                            </div>
                        </div>

                        <div class="qualification-data">
                            <div></div>

                            <div>
                                <span class="qualification-rounder"></span>
                                <span class="qualification-line"></span>
                            </div>

                            <div>
                                <h3 class="qualification-title">Programmer Analyst Trainee</h3>
                                <span class="qualification-subtitle">Cognizant</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    Jan 2021 - Jul 2021
                                </div>
                            </div>
                        </div>

                        <div class="qualification-data">
                            <div>
                                <h3 class="qualification-title">Artificial Intelligence Engineer</h3>
                                <span class="qualification-subtitle">DCKAP</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    Sep 2020 - Jan 2021
                                </div>
                            </div>

                            <div class="qualification-time">
                                <span class="qualification-rounder"></span>
                                <span class="qualification-line"></span>
                            </div>
                        </div>

                        <div class="qualification-data">
                            <div></div>

                            <div class="qualification-time">
                                <span class="qualification-rounder"></span>
                                <span class="qualification-line"></span>
                            </div>

                            <div>
                                <h3 class="qualification-title">Machine Learning Lead Facilitator</h3>
                                <span class="qualification-subtitle">Explore ML - Google AI</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    June 2019 - Feb 2020
                                </div>
                            </div>
                        </div>

                        <div class="qualification-data">
                            <div>
                                <h3 class="qualification-title">Core Developer</h3>
                                <span class="qualification-subtitle">Google Developer Student Clubs - SJCE</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    Oct 2018 - July 2021
                                </div>
                            </div>

                            <div class="qualification-time">
                                <span class="qualification-rounder"></span>
                                <span class="qualification-line"></span>
                            </div>
                        </div>

                        <div class="qualification-data">
                            <div></div>

                            <div>
                                <span class="qualification-rounder"></span>
                            </div>

                            <div>
                                <h3 class="qualification-title">Co-Founder</h3>
                                <span class="qualification-subtitle">Pyxel AI</span>
                                <div class="qualification-calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    Nov 2019 - July 2021
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section class="section projects" id="projects">
            <h2 class="section-title">Featured Projects</h2>
            <div class="projects-grid">
                <div class="project-card">
                    <div class="project-image">
                        <img src="https://via.placeholder.com/400x300" alt="Project 1">
                    </div>
                    <div class="project-info">
                        <h3>Project Title 1</h3>
                        <p>Brief description of the project, technologies used, and your role.</p>
                        <a href="#" class="project-link">View Project →</a>
                    </div>
                </div>
                <div class="project-card">
                    <div class="project-image">
                        <img src="https://via.placeholder.com/400x300" alt="Project 2">
                    </div>
                    <div class="project-info">
                        <h3>Project Title 2</h3>
                        <p>Brief description of the project, technologies used, and your role.</p>
                        <a href="#" class="project-link">View Project →</a>
                    </div>
                </div>
                <div class="project-card">
                    <div class="project-image">
                        <img src="https://via.placeholder.com/400x300" alt="Project 3">
                    </div>
                    <div class="project-info">
                        <h3>Project Title 3</h3>
                        <p>Brief description of the project, technologies used, and your role.</p>
                        <a href="#" class="project-link">View Project →</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="section contact" id="contact">
            <h2 class="section-title">Get In Touch</h2>
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <p><i class="fas fa-envelope"></i>kritarthranjan5053@gmail.com</p>
                    <p><i class="fas fa-phone"></i>+91 9559807374</p>
                    <p><i class="fas fa-map-marker-alt"></i> New Delhi, India</p>
                    
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link" aria-label="GitHub"><i class="fab fa-github"></i></a>
                        <a href="#" class="social-link" aria-label="Medium"><i class="fab fa-medium"></i></a>
                        <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <!-- In your contact section -->
                <div class="contact-form">
                    <?php if ($messageSent && !$formDisabled): ?>
                        <div class="form-success">
                            <p>Thank you for your message! I'll get back to you soon.</p>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#contact" method="POST" style="<?php echo $formDisabled ? 'display:none;' : 'display:block;' ?>">
                        <input type="hidden" name="contact_form" value="1">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group phone-input-group">
                            <input type="text" name="country_code" class="country-code" placeholder="+91" value="+91">
                            <input type="tel" name="phone" class="phone-number" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                    
                    <?php if ($formDisabled): ?>
                        <div class="form-success">
                            <p>Thank you for your message! I'll get back to you soon.</p>
                        </div>
                        <script>
                            // Show form after 10 seconds
                            setTimeout(function() {
                                document.querySelector('.contact-form form').style.display = 'block';
                                document.querySelector('.contact-form .form-success').style.display = 'none';
                            }, 10000);
                        </script>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Kritarth Ranjan. All rights reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>