
const backToTopButton = document.getElementById('btnBackToTop');
if (backToTopButton) {
    window.onscroll = function() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
    };

    backToTopButton.onclick = function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
} else {
    console.error('Back to Top button not found');
}

// Toggle content visibility for posts
function toggleContent(button) {
    const postCard = button.closest(".post-card");
    if (!postCard) {
        console.error("Post card not found");
        return;
    }
    const truncatedContent = postCard.querySelector(".post-content-truncated");
    const fullContent = postCard.querySelector(".post-content-full");
    if (truncatedContent && fullContent) {
        if (truncatedContent.style.display === "none") {
            truncatedContent.style.display = "block";
            fullContent.style.display = "none";
            button.textContent = "Vollständige Ansicht";
        } else {
            truncatedContent.style.display = "none";
            fullContent.style.display = "block";
            button.textContent = "Weniger anzeigen";
        }
    } else {
        console.error("Content elements not found");
    }
}

document.addEventListener('DOMContentLoaded', function() {
   
    document.querySelectorAll(".toggle-comment-form").forEach(button => {
        button.addEventListener("click", function() {
            const postId = this.getAttribute("data-post-id");
            const form = document.getElementById("comment-form-" + postId);
            if (form) {
                if (form.style.display === "none" || form.style.display === "") {
                    form.style.display = "block";
                    this.textContent = "Kommentarformular schließen";
                } else {
                    form.style.display = "none";
                    this.textContent = "Kommentar hinzufügen";
                }
            } else {
                console.error(`Comment form not found for post ID: ${postId}`);
            }
        });
    });

    
    document.querySelectorAll(".toggle-comments").forEach(button => {
        button.addEventListener("click", function() {
            const postId = this.getAttribute("data-post-id");
            const commentsSection = document.getElementById("comments-" + postId);
            if (commentsSection) {
                const commentCount = commentsSection.querySelectorAll(".comment").length;
                if (commentsSection.style.display === "none" || commentsSection.style.display === "") {
                    commentsSection.style.display = "block";
                    this.textContent = "Kommentare ausblenden";
                } else {
                    commentsSection.style.display = "none";
                    this.textContent = commentCount > 0 ? `Kommentare anzeigen (${commentCount})` : "Noch keine Kommentare";
                }
            } else {
                console.error(`Comments section not found for post ID: ${postId}`);
            }
        });
    });
});