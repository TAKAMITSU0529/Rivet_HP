document.addEventListener('DOMContentLoaded', () => {

  const getElementById = (id) => document.getElementById(id);

  const replyToComment = (authorId, commentId, commentBoxId) => {
    const author = getElementById(authorId).textContent.trim();
    const replyLink = `<a href="#${commentId}">@${author}</a> \n`;
    appendToCommentBox(replyLink, commentBoxId);
  };

  const quoteComment = (authorId, commentId, commentBodyId, commentBoxId) => {
    const author = getElementById(authorId).textContent.trim();
    const comment = getElementById(commentBodyId).textContent.trim();
    const quoteBlock = `<blockquote cite="#${commentBodyId}">
                          <a href="#${commentId}">${author}</a> : ${comment}
                        </blockquote>\n`;
    appendToCommentBox(quoteBlock, commentBoxId);
  };

  const appendToCommentBox = (content, commentBoxId) => {
    const commentBox = getElementById(commentBoxId);
    if (!commentBox || commentBox.type !== 'textarea') {
//      displayError("The comment box does not exist!");
      return;
    }

    if (commentBox.value.includes(content)) {
//      displayError("You've already appended this reply!");
      return;
    }

    commentBox.value = commentBox.value.trim() ? `${commentBox.value.trim()}\n\n${content}` : content;
    commentBox.focus();
  };

  const displayError = (message) => {
    console.error(message);
    // エラーメッセージをUI上に表示する場合は、ここにコードを追加
  };

  // オブジェクトの初期化
//  window.MGJS = {
//    getElementById
//  };

  window.tcd_comment_function = {
    replyToComment,
    quoteComment
  };

});