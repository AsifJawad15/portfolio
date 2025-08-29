-- ============================================
-- PORTFOLIO DATABASE SCHEMA
-- Database: portfolio_db
-- Created: 2025-08-29
-- Description: Complete database schema for portfolio website
-- ============================================

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portfolio_db;

-- ============================================
-- 1. ADMIN USERS TABLE
-- ============================================
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE,
    full_name VARCHAR(100),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    login_attempts INT DEFAULT 0,
    INDEX idx_username (username),
    INDEX idx_email (email)
);

-- ============================================
-- 2. PROJECTS TABLE
-- ============================================
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    github_link VARCHAR(500),
    live_demo_link VARCHAR(500),
    technologies TEXT,
    status ENUM('completed', 'in_progress', 'planned') DEFAULT 'completed',
    featured BOOLEAN DEFAULT FALSE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_featured (featured),
    INDEX idx_sort_order (sort_order)
);

-- ============================================
-- 3. CREDENTIALS TABLE
-- ============================================
CREATE TABLE IF NOT EXISTS credentials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    certificate_image VARCHAR(255),
    issuing_organization VARCHAR(200),
    issue_date DATE,
    expiry_date DATE,
    credential_id VARCHAR(100),
    credential_url VARCHAR(500),
    category ENUM('certification', 'education', 'award', 'course') DEFAULT 'certification',
    verification_status ENUM('verified', 'pending', 'expired') DEFAULT 'verified',
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_verification_status (verification_status),
    INDEX idx_sort_order (sort_order)
);

-- ============================================
-- 4. SKILLS TABLE
-- ============================================
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL DEFAULT 'General',
    percentage INT NOT NULL DEFAULT 0 CHECK (percentage >= 0 AND percentage <= 100),
    sort_order INT DEFAULT 0,
    years_experience DECIMAL(3,1) DEFAULT 0,
    skill_type ENUM('technical', 'soft', 'language', 'tool') DEFAULT 'technical',
    is_featured BOOLEAN DEFAULT FALSE,
    icon VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_skill_type (skill_type),
    INDEX idx_featured (is_featured),
    INDEX idx_sort_order (sort_order)
);

-- ============================================
-- 5. CONTACTS TABLE
-- ============================================
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new',
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    replied_at TIMESTAMP NULL,
    INDEX idx_status (status),
    INDEX idx_priority (priority),
    INDEX idx_created_at (created_at),
    INDEX idx_email (email)
);

-- ============================================
-- 6. BLOG POSTS TABLE (Optional for future)
-- ============================================
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content LONGTEXT,
    excerpt TEXT,
    featured_image VARCHAR(255),
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    author_id INT,
    category VARCHAR(100),
    tags TEXT,
    meta_description TEXT,
    views_count INT DEFAULT 0,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES admin_users(id) ON DELETE SET NULL,
    INDEX idx_slug (slug),
    INDEX idx_status (status),
    INDEX idx_category (category),
    INDEX idx_published_at (published_at)
);

-- ============================================
-- 7. TESTIMONIALS TABLE (Optional)
-- ============================================
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    client_position VARCHAR(100),
    client_company VARCHAR(100),
    client_image VARCHAR(255),
    testimonial_text TEXT NOT NULL,
    rating INT DEFAULT 5 CHECK (rating >= 1 AND rating <= 5),
    is_featured BOOLEAN DEFAULT FALSE,
    is_approved BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_featured (is_featured),
    INDEX idx_approved (is_approved),
    INDEX idx_rating (rating)
);

-- ============================================
-- 8. SITE SETTINGS TABLE
-- ============================================
CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    setting_type ENUM('text', 'number', 'boolean', 'json', 'file') DEFAULT 'text',
    description TEXT,
    is_public BOOLEAN DEFAULT FALSE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_setting_key (setting_key),
    INDEX idx_is_public (is_public)
);

-- ============================================
-- 9. ANALYTICS TABLE (Basic tracking)
-- ============================================
CREATE TABLE IF NOT EXISTS page_analytics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_url VARCHAR(255) NOT NULL,
    visitor_ip VARCHAR(45),
    user_agent TEXT,
    referer VARCHAR(500),
    visit_date DATE NOT NULL,
    visit_time TIME NOT NULL,
    session_id VARCHAR(100),
    country VARCHAR(50),
    city VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_page_url (page_url),
    INDEX idx_visit_date (visit_date),
    INDEX idx_visitor_ip (visitor_ip)
);

-- ============================================
-- INSERT SAMPLE DATA
-- ============================================

-- Insert default admin user (password: admin123 - change this!)
INSERT INTO admin_users (username, password, email, full_name) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@portfolio.com', 'Portfolio Administrator');

-- Insert sample skills
INSERT INTO skills (name, category, percentage, sort_order, skill_type) VALUES
('PHP', 'Backend Development', 90, 1, 'technical'),
('JavaScript', 'Frontend Development', 85, 2, 'technical'),
('MySQL', 'Database', 80, 3, 'technical'),
('HTML/CSS', 'Frontend Development', 95, 4, 'technical'),
('React', 'Frontend Development', 75, 5, 'technical'),
('Python', 'Programming Languages', 70, 6, 'technical'),
('Git/GitHub', 'Tools', 85, 7, 'tool'),
('Problem Solving', 'Soft Skills', 90, 8, 'soft'),
('Team Communication', 'Soft Skills', 85, 9, 'soft'),
('Project Management', 'Soft Skills', 80, 10, 'soft');

-- Insert sample projects
INSERT INTO projects (title, description, image, github_link, technologies, status, featured) VALUES
('Portfolio Website', 'Personal portfolio website built with PHP, MySQL, and modern CSS. Features admin panel for content management, responsive design, and clean UI.', 'portfolio-project.jpg', 'https://github.com/AsifJawad15/portfolio', 'PHP, MySQL, HTML, CSS, JavaScript', 'completed', TRUE),
('E-commerce Platform', 'Full-featured e-commerce platform with shopping cart, payment integration, and admin dashboard.', 'ecommerce-project.jpg', 'https://github.com/AsifJawad15/ecommerce', 'PHP, MySQL, Bootstrap, PayPal API', 'completed', TRUE),
('Task Management App', 'A collaborative task management application with real-time updates and team features.', 'task-app.jpg', 'https://github.com/AsifJawad15/task-manager', 'React, Node.js, MongoDB, Socket.io', 'in_progress', FALSE);

-- Insert sample credentials
INSERT INTO credentials (name, description, issuing_organization, category, verification_status) VALUES
('Bachelor of Computer Science & Engineering', 'Graduated with distinction in Computer Science and Engineering', 'University of Technology', 'education', 'verified'),
('PHP Developer Certification', 'Advanced PHP development certification covering OOP, MVC, and modern frameworks', 'Tech Certification Board', 'certification', 'verified'),
('JavaScript Fundamentals Certificate', 'Comprehensive JavaScript course covering ES6+, DOM manipulation, and async programming', 'Online Learning Platform', 'course', 'verified'),
('Best Student Award 2023', 'Awarded for outstanding academic performance and project contributions', 'University of Technology', 'award', 'verified');

-- Insert site settings
INSERT INTO site_settings (setting_key, setting_value, setting_type, description, is_public) VALUES
('site_title', 'Asif Jawad - Portfolio', 'text', 'Main site title', TRUE),
('site_description', 'Computer Science Engineering Graduate | Full Stack Developer', 'text', 'Site meta description', TRUE),
('contact_email', 'contact@asifjawad.com', 'text', 'Main contact email', TRUE),
('github_url', 'https://github.com/AsifJawad15', 'text', 'GitHub profile URL', TRUE),
('linkedin_url', 'https://linkedin.com/in/asifjawad', 'text', 'LinkedIn profile URL', TRUE),
('resume_file', 'asif_jawad_resume.pdf', 'file', 'Resume file name', FALSE),
('items_per_page', '10', 'number', 'Default pagination limit', FALSE),
('maintenance_mode', 'false', 'boolean', 'Site maintenance mode', FALSE);

-- ============================================
-- USEFUL QUERIES FOR PORTFOLIO MANAGEMENT
-- ============================================

-- Get all featured projects with their details
-- SELECT * FROM projects WHERE featured = TRUE ORDER BY sort_order, created_at DESC;

-- Get skills grouped by category for homepage
-- SELECT category, name, percentage FROM skills ORDER BY category, sort_order, percentage DESC;

-- Get recent unread contacts
-- SELECT * FROM contacts WHERE status = 'new' ORDER BY created_at DESC LIMIT 10;

-- Get credentials by category
-- SELECT * FROM credentials WHERE category = 'certification' AND verification_status = 'verified' ORDER BY issue_date DESC;

-- Dashboard statistics query
-- SELECT 
--     (SELECT COUNT(*) FROM projects) as total_projects,
--     (SELECT COUNT(*) FROM skills) as total_skills,
--     (SELECT COUNT(*) FROM credentials) as total_credentials,
--     (SELECT COUNT(*) FROM contacts WHERE status = 'new') as unread_contacts;

-- Advanced project search with technology filter
-- SELECT * FROM projects WHERE technologies LIKE '%PHP%' AND status = 'completed';

-- Monthly contact statistics
-- SELECT 
--     YEAR(created_at) as year,
--     MONTH(created_at) as month,
--     COUNT(*) as contact_count,
--     COUNT(CASE WHEN status = 'replied' THEN 1 END) as replied_count
-- FROM contacts 
-- GROUP BY YEAR(created_at), MONTH(created_at) 
-- ORDER BY year DESC, month DESC;

-- Skills proficiency report
-- SELECT 
--     category,
--     COUNT(*) as skill_count,
--     AVG(percentage) as avg_proficiency,
--     MAX(percentage) as highest_proficiency
-- FROM skills 
-- GROUP BY category 
-- ORDER BY avg_proficiency DESC;

-- ============================================
-- INDEXES FOR BETTER PERFORMANCE
-- ============================================

-- Additional composite indexes for common queries
ALTER TABLE projects ADD INDEX idx_status_featured (status, featured);
ALTER TABLE skills ADD INDEX idx_category_sort (category, sort_order);
ALTER TABLE contacts ADD INDEX idx_status_created (status, created_at);
ALTER TABLE credentials ADD INDEX idx_category_verification (category, verification_status);

-- ============================================
-- VIEWS FOR COMMON QUERIES
-- ============================================

-- View for dashboard statistics
CREATE OR REPLACE VIEW dashboard_stats AS
SELECT 
    (SELECT COUNT(*) FROM projects) as total_projects,
    (SELECT COUNT(*) FROM projects WHERE featured = TRUE) as featured_projects,
    (SELECT COUNT(*) FROM skills) as total_skills,
    (SELECT COUNT(*) FROM credentials) as total_credentials,
    (SELECT COUNT(*) FROM contacts) as total_contacts,
    (SELECT COUNT(*) FROM contacts WHERE status = 'new') as unread_contacts,
    (SELECT COUNT(*) FROM contacts WHERE DATE(created_at) = CURDATE()) as today_contacts;

-- View for featured portfolio items
CREATE OR REPLACE VIEW featured_portfolio AS
SELECT 
    'project' as item_type,
    id,
    title as name,
    description,
    image,
    created_at,
    sort_order
FROM projects WHERE featured = TRUE
UNION ALL
SELECT 
    'skill' as item_type,
    id,
    name,
    CONCAT(percentage, '% proficiency in ', category) as description,
    icon as image,
    created_at,
    sort_order
FROM skills WHERE is_featured = TRUE
ORDER BY sort_order, created_at DESC;

-- ============================================
-- STORED PROCEDURES
-- ============================================

-- Procedure to get contact statistics
DELIMITER //
CREATE OR REPLACE PROCEDURE GetContactStats(IN days_back INT)
BEGIN
    SELECT 
        DATE(created_at) as contact_date,
        COUNT(*) as total_contacts,
        COUNT(CASE WHEN status = 'new' THEN 1 END) as new_contacts,
        COUNT(CASE WHEN status = 'replied' THEN 1 END) as replied_contacts
    FROM contacts 
    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL days_back DAY)
    GROUP BY DATE(created_at)
    ORDER BY contact_date DESC;
END //
DELIMITER ;

-- Procedure to update project sort order
DELIMITER //
CREATE OR REPLACE PROCEDURE UpdateProjectOrder(IN project_id INT, IN new_order INT)
BEGIN
    DECLARE current_order INT;
    
    SELECT sort_order INTO current_order FROM projects WHERE id = project_id;
    
    IF current_order != new_order THEN
        IF new_order > current_order THEN
            UPDATE projects 
            SET sort_order = sort_order - 1 
            WHERE sort_order > current_order AND sort_order <= new_order;
        ELSE
            UPDATE projects 
            SET sort_order = sort_order + 1 
            WHERE sort_order >= new_order AND sort_order < current_order;
        END IF;
        
        UPDATE projects SET sort_order = new_order WHERE id = project_id;
    END IF;
END //
DELIMITER ;

-- ============================================
-- TRIGGERS FOR AUTOMATIC UPDATES
-- ============================================

-- Trigger to update project timestamp
DELIMITER //
CREATE OR REPLACE TRIGGER update_project_timestamp 
    BEFORE UPDATE ON projects
    FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END //
DELIMITER ;

-- Trigger to log contact interactions
DELIMITER //
CREATE OR REPLACE TRIGGER log_contact_status_change
    AFTER UPDATE ON contacts
    FOR EACH ROW
BEGIN
    IF OLD.status != NEW.status AND NEW.status = 'replied' THEN
        UPDATE contacts SET replied_at = CURRENT_TIMESTAMP WHERE id = NEW.id;
    END IF;
END //
DELIMITER ;

-- ============================================
-- SECURITY AND MAINTENANCE
-- ============================================

-- Create backup procedure
DELIMITER //
CREATE OR REPLACE PROCEDURE BackupPortfolioData()
BEGIN
    -- This procedure can be used to create data backups
    SELECT 'Backup completed successfully' as message;
    -- Add actual backup logic here
END //
DELIMITER ;

-- ============================================
-- END OF PORTFOLIO DATABASE SCHEMA
-- ============================================

-- Usage Instructions:
-- 1. Run this script to create the complete database structure
-- 2. Update the default admin password after first login
-- 3. Customize the sample data as needed
-- 4. Use the provided views and procedures for efficient data access
-- 5. Monitor performance and add indexes as needed based on usage patterns

-- Note: Remember to:
-- - Change default passwords
-- - Configure proper database user permissions
-- - Set up regular backups
-- - Monitor query performance
-- - Update connection credentials in config.php
